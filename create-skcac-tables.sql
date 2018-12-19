DROP PROCEDURE IF EXISTS insert_contact;

CREATE TABLE Account (
  account_id      INT          NOT NULL UNIQUE AUTO_INCREMENT, # Account DATABASE Unique ID
  email           VARCHAR(255) NOT NULL UNIQUE, # Account Email
  first_name      VARCHAR(40)  NOT NULL, # Account First Name
  last_name       VARCHAR(60)  NOT NULL, # Account Last Name
  salt            VARCHAR(255) NOT NULL, # Account's security salt
  password        VARCHAR(255) NOT NULL, # Accounts Password Hash
  is_staff        BOOLEAN      NOT NULL        DEFAULT FALSE, # If True this account is flagged for staff access.
  is_admin        BOOLEAN      NOT NULL        DEFAULT FALSE, # If True this account is flagged for admin rights. ie, can create other staff accounts.
  account_created DATETIME     NOT NULL        DEFAULT NOW(), # Date the account was created.
  PRIMARY KEY (account_id)
)
  ENGINE = INNODB;

DELIMITER ;;

CREATE PROCEDURE
  query_account_id
  (
    IN param_account_id INT
  )
READS SQL DATA
  BEGIN
    DECLARE errno SMALLINT UNSIGNED DEFAULT 31001;
    SET @error_message = CONCAT('Error querying account with id: ', param_account_id, ' was not found.');

    IF EXISTS(SELECT *
              FROM Account
              WHERE account_id = param_account_id
              LIMIT 1)
    THEN
      SELECT *
      FROM Account
      WHERE account_id = param_account_id
      LIMIT 1;
    ELSE
      SIGNAL SQLSTATE '45000'
      SET
      MESSAGE_TEXT = @error_message,
      MYSQL_ERRNO = errno;
    END IF;
  END ;;

DELIMITER ;

CREATE TABLE Clients (
  client_id     INT         NOT NULL UNIQUE AUTO_INCREMENT, # Participants DATABASE Unique ID
  account_id    INT         NOT NULL UNIQUE, # Reference to account
  middle_name   VARCHAR(40), # Participants Middle Name
  phone         VARCHAR(10) NOT NULL, # Participants Phone Number
  address       VARCHAR(60) NOT NULL, # Participants Street Address of Residence
  address_city  VARCHAR(40) NOT NULL, # Participants City of Residence
  address_zip   CHAR(5)     NOT NULL, # Participants Zip-code of Residence.
  address_state CHAR(2)     NOT NULL, # Participants State of Residence
  last_update   DATETIME    NOT NULL        DEFAULT NOW(), # Date Participants registration was last updated.
  active_client BOOLEAN     NOT NULL        DEFAULT TRUE, # If false, client is no longer served.
  PRIMARY KEY (client_id),
  FOREIGN KEY (account_id) REFERENCES Account (account_id)
)
  ENGINE = INNODB;

CREATE TABLE Clients_Contacts (
  contact_id     INT                                                            NOT NULL UNIQUE AUTO_INCREMENT, # Contacts DATABASE Unique ID
  client_id      INT                                                            NOT NULL, # Contacts Reference to Client
  first_name     VARCHAR(40)                                                    NOT NULL, # Contacts First Name
  last_name      VARCHAR(60)                                                    NOT NULL, # Contacts Last Name
  relation       ENUM ('Residential Provider', 'Guardian', 'NSA (Client Rep.)') NOT NULL, # Contacts Relation to the Client ie (Residential Provider, Guardian, NSA (Client Rep.))
  email          VARCHAR(255)                                                   NOT NULL, # Contacts Email Address
  phone          VARCHAR(10)                                                    NOT NULL, # Contacts Phone Number
  address        VARCHAR(60)                                                    NOT NULL, # Contacts Street Address of Residence
  address_city   VARCHAR(40)                                                    NOT NULL, # Contacts City of Residence
  address_zip    CHAR(5)                                                        NOT NULL, # Participants Zip-code of Residence.
  address_state  CHAR(2)                                                        NOT NULL, # Contacts State of Residence
  active_contact BOOLEAN                                                        NOT NULL        DEFAULT TRUE, # If True, this contact is valid, if False, do not use, just for reference.
  PRIMARY KEY (contact_id),
  FOREIGN KEY (client_id) REFERENCES Clients (client_id)
)
  ENGINE = INNODB;

DELIMITER ;;

CREATE PROCEDURE
  insert_client_contact
  (
    IN param_client_id     INT,
    IN param_first_name    VARCHAR(40),
    IN param_last_name     VARCHAR(60),
    IN param_relation      VARCHAR(20),
    IN param_email         VARCHAR(255),
    IN param_phone         VARCHAR(10),
    IN param_address       VARCHAR(60),
    IN param_address_city  VARCHAR(40),
    IN param_address_zip   CHAR(5),
    IN param_address_state CHAR(2)
  )
MODIFIES SQL DATA
  BEGIN
    DECLARE errno SMALLINT UNSIGNED DEFAULT 31001;
    SET @error_message = CONCAT('Error inserting new Contact. Client ID: ', param_client_id, ' was not found.');

    # Check if the client exists
    IF EXISTS(SELECT *
              FROM Clients
              WHERE Clients.client_id = param_client_id
              LIMIT 1)
    THEN # Client was found, start a transaction to add the contact.
      START TRANSACTION;
      SET autocommit = 0; # Disable auto commit in-case of errors.

      # Insert the Clients Contact
      INSERT INTO Clients_Contacts
      (
        client_id,
        first_name,
        last_name,
        relation,
        email,
        phone,
        address,
        address_city,
        address_zip,
        address_state
      )
      VALUES
        (param_client_id, param_first_name, param_last_name, param_relation, param_email, param_phone, param_address,
         param_address_city, param_address_zip, param_address_state);

      SET @id = LAST_INSERT_ID();

      # Add a message to the Log
      INSERT INTO Logging
      (message)
      VALUES
        (CONCAT('[insert_contact] [',
                param_client_id, ', ',
                param_first_name, ', ',
                param_last_name, ', ',
                param_relation, ', ',
                param_email, ', ',
                param_phone, ', ',
                param_address, ', ',
                param_address_city, ', ',
                param_address_zip, ', ',
                param_address_state, ']'));

      # Confirm and write to disk
      COMMIT;

      # Return the new Contact for use if needed.
      SELECT *
      FROM Clients_Contacts
      WHERE contact_id = @id
      LIMIT 1;
    ELSE # Client Not Found, throw an error message.
      SIGNAL SQLSTATE '45000'
      SET
      MESSAGE_TEXT = @error_message,
      MYSQL_ERRNO = errno;
    END IF;
  END;;

DELIMITER ;

CREATE TABLE Clients_Emergency_Contacts (
  emergency_contact_id INT         NOT NULL UNIQUE        AUTO_INCREMENT, # Emergency Contact DATABASE Unique ID
  client_id            INT         NOT NULL, # Emergency Contact Reference to Client
  first_name           VARCHAR(40) NOT NULL, # Emergency Contact First Name
  last_name            VARCHAR(60) NOT NULL, # Emergency Contact Last Name
  phone                VARCHAR(10) NOT NULL, # Emergency Contact Phone Number
  alternate_phone      VARCHAR(10) NOT NULL, # Emergency Contact Alternate Phone Number
  active_contact       BOOLEAN     NOT NULL               DEFAULT TRUE, # If True, this contact is valid, if false, do not use, just for reference.
  PRIMARY KEY (emergency_contact_id),
  FOREIGN KEY (client_id) REFERENCES Clients (client_id)
)
  ENGINE = INNODB;

CREATE TABLE Clients_Medical_Alerts (
  id        INT     NOT NULL UNIQUE AUTO_INCREMENT, # Medical Alert DATABASE Unique ID
  client_id INT     NOT NULL, # Medical Alert Reference to Client
  alert     TEXT    NOT NULL, # Medical Alert Message
  active    BOOLEAN NOT NULL        DEFAULT TRUE, # If true, this alert is in use.
  PRIMARY KEY (id),
  FOREIGN KEY (client_id) REFERENCES Clients (client_id)
)
  ENGINE = INNODB;

CREATE TABLE Clients_Physical_Limitations (
  id         INT     NOT NULL UNIQUE AUTO_INCREMENT, # Physical Limitation
  client_id  INT     NOT NULL, # Physical Limitation
  limitation TEXT    NOT NULL, # Physical Limitation
  active     BOOLEAN NOT NULL        DEFAULT TRUE, # Physical Limitation
  PRIMARY KEY (id),
  FOREIGN KEY (client_id) REFERENCES Clients (client_id)
)
  ENGINE = INNODB;

CREATE TABLE Clients_Diet_Restrictions (
  id          INT     NOT NULL UNIQUE AUTO_INCREMENT, # Diet Restriction
  client_id   INT     NOT NULL, # Diet Restriction
  restriction TEXT    NOT NULL, # Diet Restriction
  active      BOOLEAN NOT NULL        DEFAULT TRUE, # Diet Restriction
  PRIMARY KEY (id),
  FOREIGN KEY (client_id) REFERENCES Clients (client_id)
)
  ENGINE = INNODB;

CREATE TABLE Clients_Medications (
  id         INT          NOT NULL UNIQUE AUTO_INCREMENT, #
  client_id  INT          NOT NULL, #
  medication TEXT         NOT NULL, #
  dosage     VARCHAR(255) NOT NULL, #
  frequency  VARCHAR(255) NOT NULL, #
  time_taken VARCHAR(255) NOT NULL, #
  active     BOOLEAN      NOT NULL        DEFAULT TRUE, #
  PRIMARY KEY (id),
  FOREIGN KEY (client_id) REFERENCES Clients (client_id)
)
  ENGINE = INNODB;

CREATE TABLE Employees_Clients (
  id        INT NOT NULL UNIQUE AUTO_INCREMENT, #
  staff_id  INT NOT NULL, #
  client_id INT NOT NULL, #
  PRIMARY KEY (id),
  FOREIGN KEY (staff_id) REFERENCES Account (account_id),
  FOREIGN KEY (client_id) REFERENCES Account (account_id),
  UNIQUE (staff_id, client_id) # Prevent Duplicates Associations, may not work with current mariaDB version.
)
  ENGINE = INNODB;

########################################################################################################################
##### Logging ##########################################################################################################
########################################################################################################################

CREATE TABLE Logging (
  id        INT       NOT NULL UNIQUE AUTO_INCREMENT,
  timestamp TIMESTAMP NOT NULL        DEFAULT now(),
  message   LONGTEXT  NOT NULL,
  PRIMARY KEY (id)
)
  ENGINE = INNODB;