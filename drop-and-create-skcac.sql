# Drops all Tables

DROP TABLE IF EXISTS Clients_Contacts;
DROP TABLE IF EXISTS Clients_Emergency_Contacts;
DROP TABLE IF EXISTS Clients_Medical_Alerts;
DROP TABLE IF EXISTS Clients_Physical_Limitations;
DROP TABLE IF EXISTS Clients_Diet_Restrictions;
DROP TABLE IF EXISTS Employees_Clients;
DROP TABLE IF EXISTS Clients_Medications;
DROP TABLE IF EXISTS Clients;
DROP TABLE IF EXISTS Account;
DROP TABLE IF EXISTS Logging;

# Drop all Procedures
DROP PROCEDURE IF EXISTS query_account_id;
DROP PROCEDURE IF EXISTS query_account_email;
DROP PROCEDURE IF EXISTS query_account_all;
DROP PROCEDURE IF EXISTS query_account_participants;
DROP PROCEDURE IF EXISTS query_account_staff;
DROP PROCEDURE IF EXISTS query_participant_search;

DROP PROCEDURE IF EXISTS update_account_id;

DROP PROCEDURE IF EXISTS insert_participant;
DROP PROCEDURE IF EXISTS insert_client;
DROP PROCEDURE IF EXISTS insert_client_contact;
DROP PROCEDURE IF EXISTS insert_client_diet_restriction;
DROP PROCEDURE IF EXISTS insert_client_emergency_contact;
DROP PROCEDURE IF EXISTS insert_client_medical_alert;
DROP PROCEDURE IF EXISTS insert_client_medication;
DROP PROCEDURE IF EXISTS insert_client_physical_limitation;

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

CREATE TABLE Clients_Emergency_Contacts (
  emergency_contact_id INT         NOT NULL UNIQUE        AUTO_INCREMENT, # Emergency Contact DATABASE Unique ID
  client_id            INT         NOT NULL, # Emergency Contact Reference to Client
  first_name           VARCHAR(40) NOT NULL, # Emergency Contact First Name
  last_name            VARCHAR(60) NOT NULL, # Emergency Contact Last Name
  phone                VARCHAR(10) NOT NULL, # Emergency Contact Phone Number
  alternate_phone      VARCHAR(10), # Emergency Contact Alternate Phone Number
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

########################################################################################################################
##### Procedures #######################################################################################################
########################################################################################################################

DELIMITER ;;

##### Account Procedures ###############################################################################################

CREATE PROCEDURE
  query_account_all()
READS SQL DATA
  BEGIN
    SELECT *
    FROM Account;
  END ;;

CREATE PROCEDURE
  query_account_staff()
READS SQL DATA
  BEGIN
    SELECT *
    FROM Account
    WHERE
      is_staff = 1;
  END ;;

CREATE PROCEDURE
  query_account_participants()
READS SQL DATA
  BEGIN
    SELECT *
    FROM Account
    WHERE
      is_staff = 0;
  END ;;

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

CREATE PROCEDURE
  query_account_email
  (
    IN param_account_email VARCHAR(255)
  )
READS SQL DATA
  BEGIN
    DECLARE errno SMALLINT UNSIGNED DEFAULT 31001;
    SET @error_message = CONCAT('Error querying account with email: ', param_account_email, ' was not found.');

    IF EXISTS(SELECT *
              FROM Account
              WHERE email = param_account_email
              LIMIT 1)
    THEN
      SELECT *
      FROM Account
      WHERE email = param_account_email
      LIMIT 1;
    ELSE
      SIGNAL SQLSTATE '45000'
      SET
      MESSAGE_TEXT = @error_message,
      MYSQL_ERRNO = errno;
    END IF;
  END ;;

CREATE PROCEDURE
  update_account_id
  (
    IN param_account_id INT,
    IN param_email      VARCHAR(255),
    IN param_first_name VARCHAR(40),
    IN param_last_name  VARCHAR(60),
    IN param_salt       VARCHAR(255),
    IN param_password   VARCHAR(255),
    IN param_is_staff   BOOLEAN,
    IN param_is_admin   BOOLEAN
  )
MODIFIES SQL DATA
  BEGIN
    DECLARE errno SMALLINT UNSIGNED DEFAULT 31001;
    SET @error_message = CONCAT('Error updating account. Account ID: ', param_account_id, ' was not found. [',
                                param_account_id, ', ',
                                param_email, ', ',
                                param_first_name, ', ',
                                param_last_name, ', ',
                                param_is_staff, ', ',
                                param_is_admin, ']');
    IF EXISTS(SELECT *
              FROM Account
              WHERE account_id = param_account_id
              LIMIT 1)
    THEN
      START TRANSACTION;
      SET AUTOCOMMIT = 0;

      UPDATE Account
      SET
        email      = param_email,
        first_name = param_first_name,
        last_name  = param_last_name,
        salt       = param_salt,
        password   = param_password,
        is_staff   = param_is_staff,
        is_admin   = param_is_admin
      WHERE
        account_id = param_account_id;

      INSERT INTO Logging
      (message)
      VALUES
        (CONCAT('[update_account_id] [',
                param_account_id, ', ',
                param_email, ', ',
                param_first_name, ', ',
                param_last_name, ', ',
                param_is_staff, ', ',
                param_is_admin, ']'));

      COMMIT;

      SELECT *
      FROM
        Account
      WHERE
        account_id = param_account_id
      LIMIT 1;
    ELSE
      SIGNAL SQLSTATE '45000'
      SET
      MESSAGE_TEXT = @error_message,
      MYSQL_ERRNO = errno;
    END IF;
  END ;;

##### Client Procedures ################################################################################################

CREATE PROCEDURE
  insert_client
  (
    IN param_account_id    INT,
    IN param_middle_name   VARCHAR(40),
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

    IF EXISTS(SELECT *
              FROM Account
              WHERE account_id = param_account_id)
    THEN
      START TRANSACTION;
      SET AUTOCOMMIT = 0; # Disable auto commit in-case of errors.

      # Insert the Clients Contact
      INSERT INTO Clients
      (
        account_id,
        middle_name,
        phone,
        address,
        address_city,
        address_zip,
        address_state
      )
      VALUES
        (param_account_id, param_middle_name, param_phone, param_address, param_address_city, param_address_zip,
         param_address_state);

      SET @id = LAST_INSERT_ID();

      # Add a message to the Log
      INSERT INTO Logging
      (message)
      VALUES
        (CONCAT('[insert_client] [',
                param_account_id, ', ',
                param_middle_name, ', ',
                param_phone, ', ',
                param_address, ', ',
                param_address_city, ', ',
                param_address_zip, ', ',
                param_address_state, ']'));

      # Confirm and write to disk
      COMMIT;

      # Return the new Contact for use if needed.
      SELECT *
      FROM Clients
      WHERE client_id = @id
      LIMIT 1;
    ELSE
      SIGNAL SQLSTATE '45000'
      SET
      MESSAGE_TEXT = @error_message,
      MYSQL_ERRNO = errno;
    END IF;
  END ;;

##### Participant Procedures ###########################################################################################

CREATE PROCEDURE
  query_participant_search
  (
    IN param_search      VARCHAR(255),
    IN param_offset      INT,
    IN param_sort_column VARCHAR(255),
    IN param_order       INT
  )
READS SQL DATA
  BEGIN
    SELECT *
    FROM Clients
      INNER JOIN Account ON Clients.account_id = Account.account_id
    WHERE
      Clients.active_client = 1 AND
      Account.email LIKE CONCAT('%', param_search, '%') OR
      Account.first_name LIKE CONCAT('%', param_search, '%') OR
      Account.last_name LIKE CONCAT('%', param_search, '%') OR
      Clients.phone LIKE CONCAT('%', param_search, '%')
    ORDER BY
      CASE WHEN param_order = 1
        THEN
          CASE
          WHEN param_sort_column = 'email'
            THEN email
          WHEN param_sort_column = 'name'
            THEN last_name
          WHEN param_sort_column = 'phone'
            THEN phone
          WHEN param_sort_column = 'last_update'
            THEN last_update
          END
      END ASC,
      CASE WHEN param_order = 0
        THEN
          CASE
          WHEN param_sort_column = 'email'
            THEN email
          WHEN param_sort_column = 'name'
            THEN last_name
          WHEN param_sort_column = 'phone'
            THEN phone
          WHEN param_sort_column = 'last_update'
            THEN last_update
          END
      END DESC
    LIMIT 25 OFFSET param_offset;
  END ;;

CREATE PROCEDURE
  insert_participant
  (
    IN param_first_name    VARCHAR(40),
    IN param_last_name     VARCHAR(60),
    IN param_middle_name   VARCHAR(40),
    IN param_email         VARCHAR(255),
    IN param_phone         VARCHAR(10),
    IN param_password      VARCHAR(255),
    IN param_salt          VARCHAR(255),
    IN param_address       VARCHAR(60),
    IN param_address_city  VARCHAR(40),
    IN param_address_zip   CHAR(5),
    IN param_address_state CHAR(2),
    IN param_is_staff      BOOL
  )
MODIFIES SQL DATA
  BEGIN
    DECLARE errno SMALLINT UNSIGNED DEFAULT 31001;
    SET @error_message = CONCAT('Error inserting new Participant. Account already exists.');
    IF NOT EXISTS(SELECT *
                  FROM Account
                  WHERE email = param_email)
    THEN
      START TRANSACTION;
      SET AUTOCOMMIT = 0;

      INSERT INTO Account
      (email, first_name, last_name, salt, password, is_staff)
      VALUES
        (param_email, param_first_name, param_last_name, param_salt, param_password, param_is_staff);

      SET @id = LAST_INSERT_ID();

      INSERT INTO Clients
      (account_id, middle_name, phone, address, address_city, address_zip, address_state)
      VALUES
        (@id, param_middle_name, param_phone, param_address, param_address_city, param_address_zip,
         param_address_state);

      INSERT INTO Logging
      (message)
      VALUES
        (CONCAT('[insert_participant] [',
                param_first_name, ', ',
                param_last_name, ', ',
                param_middle_name, ', ',
                param_email, ', ',
                param_phone, ', ',
                param_address, ', ',
                param_address_city, ', ',
                param_address_zip, ', ',
                param_address_state, ', ',
                param_is_staff, ']'));

      COMMIT;

      SELECT *
      FROM Clients
        INNER JOIN Account ON Clients.account_id = Account.account_id
      WHERE Account.account_id = @id
      LIMIT 1;
    ELSE
      SIGNAL SQLSTATE '45000'
      SET
      MESSAGE_TEXT = @error_message,
      MYSQL_ERRNO = errno;
    END IF;
    COMMIT;
  END ;;

##### Client Contact Procedures ########################################################################################

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
      SET AUTOCOMMIT = 0; # Disable auto commit in-case of errors.

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
        (CONCAT('[insert_client_contact] [',
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

##### Client Emergency Contact Procedures ##############################################################################

CREATE PROCEDURE
  insert_client_emergency_contact
  (
    IN param_client_id       INT,
    IN param_first_name      VARCHAR(40),
    IN param_last_name       VARCHAR(60),
    IN param_phone           VARCHAR(10),
    IN param_alternate_phone VARCHAR(10)
  )
MODIFIES SQL DATA
  BEGIN
    DECLARE errno SMALLINT UNSIGNED DEFAULT 31001;
    SET @error_message = CONCAT('Error inserting new Emergency Contact. Client ID: ', param_client_id,
                                ' was not found.');

    # Check if the client exists
    IF EXISTS(SELECT *
              FROM Clients
              WHERE Clients.client_id = param_client_id
              LIMIT 1)
    THEN # Client was found, start a transaction to add the contact.
      START TRANSACTION;
      SET AUTOCOMMIT = 0; # Disable auto commit in-case of errors.

      # Insert the Clients Contact
      INSERT INTO Clients_Emergency_Contacts
      (
        client_id,
        first_name,
        last_name,
        phone,
        alternate_phone
      )
      VALUES
        (param_client_id, param_first_name, param_last_name, param_phone, param_alternate_phone);

      SET @id = LAST_INSERT_ID();

      # Add a message to the Log
      INSERT INTO Logging
      (message)
      VALUES
        (CONCAT('[insert_client_emergency_contact] [',
                param_client_id, ', ',
                param_first_name, ', ',
                param_last_name, ', ',
                param_phone, ', ',
                param_alternate_phone, ']'));

      # Confirm and write to disk
      COMMIT;

      # Return the new Contact for use if needed.
      SELECT *
      FROM Clients_Emergency_Contacts
      WHERE emergency_contact_id = @id
      LIMIT 1;
    ELSE # Client Not Found, throw an error message.
      SIGNAL SQLSTATE '45000'
      SET
      MESSAGE_TEXT = @error_message,
      MYSQL_ERRNO = errno;
    END IF;
  END;;

##### Client Diet Restriction Procedure ################################################################################

CREATE PROCEDURE
  insert_client_diet_restriction
  (
    IN param_client_id   INT,
    IN param_restriction TEXT
  )
MODIFIES SQL DATA
  BEGIN
    DECLARE errno SMALLINT UNSIGNED DEFAULT 31001;
    SET @error_message = CONCAT('Error inserting new Diet Restriction. Client ID: ', param_client_id,
                                ' was not found.');

    # Check if the client exists
    IF EXISTS(SELECT *
              FROM Clients
              WHERE Clients.client_id = param_client_id
              LIMIT 1)
    THEN # Client was found, start a transaction to add the contact.
      START TRANSACTION;
      SET AUTOCOMMIT = 0; # Disable auto commit in-case of errors.

      # Insert the Clients Contact
      INSERT INTO Clients_Diet_Restrictions
      (
        client_id,
        restriction
      )
      VALUES
        (param_client_id, param_restriction);

      SET @id = LAST_INSERT_ID();

      # Add a message to the Log
      INSERT INTO Logging
      (message)
      VALUES
        (CONCAT('[insert_client_diet_restriction] [',
                param_client_id, ', ',
                param_restriction, ']'));

      # Confirm and write to disk
      COMMIT;

      # Return the new Contact for use if needed.
      SELECT *
      FROM Clients_Diet_Restrictions
      WHERE id = @id
      LIMIT 1;
    ELSE # Client Not Found, throw an error message.
      SIGNAL SQLSTATE '45000'
      SET
      MESSAGE_TEXT = @error_message,
      MYSQL_ERRNO = errno;
    END IF;
  END;;

##### Client Medication Procedures #####################################################################################

CREATE PROCEDURE
  insert_client_medication
  (
    IN param_client_id  INT,
    IN param_medication TEXT,
    IN param_dosage     VARCHAR(255),
    IN param_frequency  VARCHAR(255),
    IN param_time_taken VARCHAR(255)
  )
MODIFIES SQL DATA
  BEGIN
    DECLARE errno SMALLINT UNSIGNED DEFAULT 31001;
    SET @error_message = CONCAT('Error inserting new Medication. Client ID: ', param_client_id, ' was not found.');

    # Check if the client exists
    IF EXISTS(SELECT *
              FROM Clients
              WHERE Clients.client_id = param_client_id
              LIMIT 1)
    THEN # Client was found, start a transaction to add the contact.
      START TRANSACTION;
      SET AUTOCOMMIT = 0; # Disable auto commit in-case of errors.

      # Insert the Clients Contact
      INSERT INTO Clients_Medications
      (
        client_id,
        medication,
        dosage,
        frequency,
        time_taken
      )
      VALUES
        (param_client_id, param_medication, param_dosage, param_frequency, param_time_taken);

      SET @id = LAST_INSERT_ID();

      # Add a message to the Log
      INSERT INTO Logging
      (message)
      VALUES
        (CONCAT('[insert_client_medication] [',
                param_client_id, ', ',
                param_medication, ', ',
                param_dosage, ', ',
                param_frequency, ', ',
                param_time_taken, ']'));

      # Confirm and write to disk
      COMMIT;

      # Return the new Contact for use if needed.
      SELECT *
      FROM Clients_Medications
      WHERE id = @id
      LIMIT 1;
    ELSE # Client Not Found, throw an error message.
      SIGNAL SQLSTATE '45000'
      SET
      MESSAGE_TEXT = @error_message,
      MYSQL_ERRNO = errno;
    END IF;
  END;;

##### Client Medical Alert Procedures ##################################################################################

CREATE PROCEDURE
  insert_client_medical_alert
  (
    IN param_client_id INT,
    IN param_alert     TEXT
  )
MODIFIES SQL DATA
  BEGIN
    DECLARE errno SMALLINT UNSIGNED DEFAULT 31001;
    SET @error_message = CONCAT('Error inserting new Medical Alert. Client ID: ', param_client_id, ' was not found.');

    # Check if the client exists
    IF EXISTS(SELECT *
              FROM Clients
              WHERE Clients.client_id = param_client_id
              LIMIT 1)
    THEN # Client was found, start a transaction to add the contact.
      START TRANSACTION;
      SET AUTOCOMMIT = 0; # Disable auto commit in-case of errors.

      # Insert the Clients Contact
      INSERT INTO Clients_Medical_Alerts
      (
        client_id,
        alert
      )
      VALUES
        (param_client_id, param_alert);

      SET @id = LAST_INSERT_ID();

      # Add a message to the Log
      INSERT INTO Logging
      (message)
      VALUES
        (CONCAT('[insert_client_medical_alert] [',
                param_client_id, ', ',
                param_alert, ']'));

      # Confirm and write to disk
      COMMIT;

      # Return the new Contact for use if needed.
      SELECT *
      FROM Clients_Medical_Alerts
      WHERE id = @id
      LIMIT 1;
    ELSE # Client Not Found, throw an error message.
      SIGNAL SQLSTATE '45000'
      SET
      MESSAGE_TEXT = @error_message,
      MYSQL_ERRNO = errno;
    END IF;
  END;;

##### Client Physical Limitation Procedures ############################################################################

CREATE PROCEDURE
  insert_client_physical_limitation
  (
    IN param_client_id  INT,
    IN param_limitation TEXT
  )
MODIFIES SQL DATA
  BEGIN
    DECLARE errno SMALLINT UNSIGNED DEFAULT 31001;
    SET @error_message = CONCAT('Error inserting new Physical Limitation. Client ID: ', param_client_id,
                                ' was not found.');

    # Check if the client exists
    IF EXISTS(SELECT *
              FROM Clients
              WHERE Clients.client_id = param_client_id
              LIMIT 1)
    THEN # Client was found, start a transaction to add the contact.
      START TRANSACTION;
      SET AUTOCOMMIT = 0; # Disable auto commit in-case of errors.

      # Insert the Clients Contact
      INSERT INTO Clients_Physical_Limitations
      (
        client_id,
        limitation
      )
      VALUES
        (param_client_id, param_limitation);

      SET @id = LAST_INSERT_ID();

      # Add a message to the Log
      INSERT INTO Logging
      (message)
      VALUES
        (CONCAT('[insert_client_physical_limitation] [',
                param_client_id, ', ',
                param_limitation, ']'));

      # Confirm and write to disk
      COMMIT;

      # Return the new Contact for use if needed.
      SELECT *
      FROM Clients_Physical_Limitations
      WHERE id = @id
      LIMIT 1;
    ELSE # Client Not Found, throw an error message.
      SIGNAL SQLSTATE '45000'
      SET
      MESSAGE_TEXT = @error_message,
      MYSQL_ERRNO = errno;
    END IF;
  END;;