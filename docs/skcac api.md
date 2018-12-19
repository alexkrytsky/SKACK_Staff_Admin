# SKCAC API

Install chrome extension: [MarkView](https://chrome.google.com/webstore/detail/markview/ehnambpmkdhopilaccgfmojilolcglhn?hl=en) to view in the browser.

## PHP Objects
### Account
| Fields          | Field Type | Default Value | Description                          | Getter                                | Setter                                               |
|:----------------|:-----------|:--------------|:-------------------------------------|:--------------------------------------|:-----------------------------------------------------|
| account_id      | int        | AutoIncrement | Unique ID of the account.            | $account->getAccountID() : int        |                                                      |
| email           | string     |               | Unique email address of the account. | $account->getEmail() : string         | $account->setEmail(string: email)                    |
| first_name      | string     |               | First name of the account.           | $account->getFirstName(): string      | $account->setFirstName(string: first_name)           |
| last_name       | string     |               | Last name of the account.            | $account->getLastName(): string       | $account->setLastName(string: last_name)             |
| salt            | string     |               | Salt for password hashing.           | $account->getSalt(): string           | $account->setSalt(string: salt)                      |
| password        | string     |               | Hashed password.                     | $account->getPassword(): string       | $account->setPassword(string: password)              |
| is_staff        | bool       | false         | Flag for staff permissions.          | $account->isStaff(): bool             | $account->setIsStaff(bool: is_staff)                 |
| is_admin        | bool       | false         | Flag for admin permissions.          | $account->isAdmin(): bool             | $account->setIsAdmin(bool: is_admin)                 |
| account_created | string     | now()         | When the account was created.        | $account->getAccountCreated(): string | $account->setAccountCreated(string: account_created) |

| Type     | Methods                                          | Description                                                                             | Usage                                                   |
|:---------|:-------------------------------------------------|:----------------------------------------------------------------------------------------|:--------------------------------------------------------|
| static   | query_from_email(string: email): Account or bool | Access an account from the database by their email address, returns false if not found. | `Account::query_from_email("example@mail.com");`        |
| static   | query_from_id(int: id): Account or bool          | Access an account from the database by their ID, returns false if not found.            | `Account::query_from_id(123);`                          |
| static   | query_all(): Account[]                           | Returns an array of all accounts in the database.                                       | `Account::query_all();`                                 |
| static   | query_staff(): Account[]                         | Returns an array of all staff accounts in the database.                                 | `Account::query_staff();`                               |
| static   | query_participants(): Account[]                  | Returns an array of all participant accounts in the database.                           | `Account::query_participants();`                        |
| instance | update(array: $changes): Account or bool         | Updates an account with the fields passed in with the array.                            | `$account->update(array('email' => 'test@email.com'));` |

_Notes: To insert a new account, it is recommended to create a Participant object so that all fields and database keys are set correctly._

### Client
| Fields        | Field Type | Default Value | Description                      | Getter                             | Setter                                          |
|:--------------|:-----------|:--------------|:---------------------------------|:-----------------------------------|:------------------------------------------------|
| client_id     | int        | AutoIncrement | Unique ID of the client          | $client->getClientId(): int        |                                                 |
| account_id    | int        |               | Unique ID of the related account | $client->getAccountId(): int       |                                                 |
| middle_name   | string     |               | Middle name of the client        | $client->getMiddleName(): string   | $client->setMiddleName(string: middle_name)     |
| phone         | string     |               | Phone number                     | $client->getPhone(): string        | $client->setPhone(string: phone)                |
| address       | string     |               | Street Address                   | $client->getAddress(): string      | $client->setAddress(string: address)            |
| address_city  | string     |               | City                             | $client->getAddressCity(): string  | $client->setAddressCity(string: address_city)   |
| address_zip   | string     |               | Zip Code                         | $client->getAddressZip(): string   | $client->setAddressZip(string: address_zip)     |
| address_state | string     |               | State                            | $client->getAddressState(): string | $client->setAddressState(string: address_state) |
| last_update   | string     | now()         | Clients last registration        | $client->getLastUpdate(): string   | $client->setLastUpdate(string: last_update)     |
| active_client | string     | true          | If false, ignore this client     | $client->isActiveClient(): bool    | $client->setIsActiveClient(bool: active_client) |

| Type     | Methods                                              | Description                                                                | Usage                                              |
|:---------|:-----------------------------------------------------|:---------------------------------------------------------------------------|:---------------------------------------------------|
| static   | query_from_id(int: id): Client or bool               | Access a client from the database by their ID, returns false if not found. | `Client::query_from_id(123);`                      |
| static   | query_all(): Client[]                                | Returns an array of all Clients in the database.                           | `Client::query_all();`                             |
| instance | update(array: $changes): Client or bool              | Updates a client with the fields passed in with the array.                 | `$client->update(array('phone' => '1234561234'));` |
| instance | get_contacts(): Contact[]                            | Returns an array of all a clients Contacts in the database.                | `$client->get_contacts();`                         |
| instance | get_contact(int: id): Contact                        | Access a contact from the database by it's ID                              | `$client->get_contact(123)`                        |
| instance | get_emergency_contacts(): EmergencyContact[]         | Returns an array of all a clients Emergency Contacts in the database.      | `$client->get_emergency_contacts();`               |
| instance | get_emergency_contact(int: id): EmergencyContact     | Access a emergency contact from the database by it's ID                    | `$client->get_emergency_contact(123);`             |
| instance | get_medical_alerts(): MedicalAlert[]                 | Returns an array of all a clients Medical Alerts in the database.          | `$client->get_medical_alerts();`                   |
| instance | get_medical_alert(int: id): MedicalAlert             | Access a medical alert from the database by it's ID                        | `$client->get_medical_alert(123);`                 |
| instance | get_physical_limitations(): PhysicalLimitation[]     | Returns an array of all a clients Physical Limitations in the database.    | `$client->get_physical_limitations();`             |
| instance | get_physical_limitation(int: id): PhysicalLimitation | Access a physical limitation from the database by it's ID                  | `$client->get_physical_limitation(123);`           |
| instance | get_diet_restrictions(): DietRestrictions[]          | Returns an array of all a clients Diet Restrictions in the database.       | `$client->get_diet_restrictions();`                |
| instance | get_diet_restriction(int: id): DietRestriction       | Access a diet restriction from the database by it's ID                     | `$client->get_diet_restriction(123);`              |
| instance | get_medications(): Medications[]                     | Returns an array of all a clients Medications in the database.             | `$client->get_medications();`                      |
| instance | get_medication(int: id): Medication                  | Access a medication from the database by it's ID                           | `$client->get_medication(123);`                    |

_Notes: To insert a new client, it is recommended to create a Participant object so that all fields and database keys are set correctly._

### Participant - *Combines Account and Client*
_Participants are simply an extension of Account, using JOIN in the database request to add Client table information._

| Fields          | Field Type | Default Value | Description                          | Getter                                    | Setter                                                   |
|:----------------|:-----------|:--------------|:-------------------------------------|:------------------------------------------|:---------------------------------------------------------|
| account_id      | int        | AutoIncrement | Unique ID of the account.            | $participant->getAccountID() : int        |                                                          |
| email           | string     |               | Unique email address of the account. | $participant->getEmail() : string         | $participant->setEmail(string: email)                    |
| first_name      | string     |               | First name of the account.           | $participant->getFirstName(): string      | $participant->setFirstName(string: first_name)           |
| last_name       | string     |               | Last name of the account.            | $participant->getLastName(): string       | $participant->setLastName(string: last_name)             |
| salt            | string     |               | Salt for password hashing.           | $participant->getSalt(): string           | $participant->setSalt(string: salt)                      |
| password        | string     |               | Hashed password.                     | $participant->getPassword(): string       | $participant->setPassword(string: password)              |
| is_staff        | bool       | false         | Flag for staff permissions.          | $participant->isStaff(): bool             | $participant->setIsStaff(bool: is_staff)                 |
| is_admin        | bool       | false         | Flag for admin permissions.          | $participant->isAdmin(): bool             | $participant->setIsAdmin(bool: is_admin)                 |
| account_created | string     | now()         | When the account was created.        | $participant->getAccountCreated(): string | $participant->setAccountCreated(string: account_created) |
| client_id       | int        | AutoIncrement | Unique ID of the client              | $participant->getClientId(): int          |                                                          |
| middle_name     | string     |               | Middle name of the client            | $participant->getMiddleName(): string     | $participant->setMiddleName(string: middle_name)         |
| phone           | string     |               | Phone number                         | $participant->getPhone(): string          | $participant->setPhone(string: phone)                    |
| address         | string     |               | Street Address                       | $participant->getAddress(): string        | $participant->setAddress(string: address)                |
| address_city    | string     |               | City                                 | $participant->getAddressCity(): string    | $participant->setAddressCity(string: address_city)       |
| address_zip     | string     |               | Zip Code                             | $participant->getAddressZip(): string     | $participant->setAddressZip(string: address_zip)         |
| address_state   | string     |               | State                                | $participant->getAddressState(): string   | $participant->setAddressState(string: address_state)     |
| last_update     | string     | now()         | Clients last registration            | $participant->getLastUpdate(): string     | $participant->setLastUpdate(string: last_update)         |
| active_client   | string     | true          | If false, ignore this client         | $participant->isActiveClient(): bool      | $participant->setIsActiveClient(bool: active_client)     |

| Type     | Methods                                                                               | Description                                                                                               | Usage                                                         |
|:---------|:--------------------------------------------------------------------------------------|:----------------------------------------------------------------------------------------------------------|:--------------------------------------------------------------|
| static   | query_all(): Participant[]                                                            | Returns an array of all Participants from the database.                                                   | `Participant::query_all();`                                   |
| static   | query_search(int: offset, string: search, string: column, bool: order): Participant[] | Returns an array of results from the search, ordered by the column, and ascending if order is true.       | `Participant::query_search(25, "tes", "name", true);`         |
| static   | query_from_account_id(int: account_id): Participant or bool                           | Access a Participant from the database by their ID, returns false if not found.                           | `Participant::query_from_account_id(123);`                    |
| static   | query_from_client_id(int: client_id): Participant or bool                             | Access a Participant from the database by their ID, returns false if not found.                           | `Participant::query_from_client_id(123);`                     |
| static   | query_from_account_email(string: email): Participant or bool                          | Access a Participant from the database by their email, returns false if not found.                        | `Participant::query_from_account_email("example.email.com");` |
| static   | insert(array: $request): Participant or bool                                          | Insert a new Account & Client row from the data provided in the array.                                    | `Participant::insert(array('first_name' => 'alex', ...));`    |
| instance | update(array: $changes): bool                                                         | Update the participants data with the fields passed in with the array, returns true if successful.        | `$participant->update(array('first_name' => 'joe', ...));`    |
| instance | get_client(): Client                                                                  | Get the Client object this Participant represents, keeping the current modifications to the participant.  | `$participant->get_client();`                                 |
| instance | get_account(): Account                                                                | Get the Account object this participant represents, keeping the current modifications to the participant. | `$participant->get_account();`                                |
| instance | get_contacts(): Contact[]                                                             | Returns an array of all a clients Contacts in the database.                                               | `$participant->get_contacts();`                               |
| instance | get_contact(int: id): Contact                                                         | Access a contact from the database by it's ID                                                             | `$participant->get_contact(123)`                              |
| instance | get_emergency_contacts(): EmergencyContact[]                                          | Returns an array of all a clients Emergency Contacts in the database.                                     | `$participant->get_emergency_contacts();`                     |
| instance | get_emergency_contact(int: id): EmergencyContact                                      | Access a emergency contact from the database by it's ID                                                   | `$participant->get_emergency_contact(123);`                   |
| instance | get_medical_alerts(): MedicalAlert[]                                                  | Returns an array of all a clients Medical Alerts in the database.                                         | `$participant->get_medical_alerts();`                         |
| instance | get_medical_alert(int: id): MedicalAlert                                              | Access a medical alert from the database by it's ID                                                       | `$participant->get_medical_alert(123);`                       |
| instance | get_physical_limitations(): PhysicalLimitation[]                                      | Returns an array of all a clients Physical Limitations in the database.                                   | `$participant->get_physical_limitations();`                   |
| instance | get_physical_limitation(int: id): PhysicalLimitation                                  | Access a physical limitation from the database by it's ID                                                 | `$participant->get_physical_limitation(123);`                 |
| instance | get_diet_restrictions(): DietRestrictions[]                                           | Returns an array of all a clients Diet Restrictions in the database.                                      | `$participant->get_diet_restrictions();`                      |
| instance | get_diet_restriction(int: id): DietRestriction                                        | Access a diet restriction from the database by it's ID                                                    | `$participant->get_diet_restriction(123);`                    |
| instance | get_medications(): Medications[]                                                      | Returns an array of all a clients Medications in the database.                                            | `$participant->get_medications();`                            |
| instance | get_medication(int: id): Medication                                                   | Access a medication from the database by it's ID                                                          | `$participant->get_medication(123);`                          |

### Contact
| Fields          | Field Type |
|:---------------|:-----------|
| contact_id     | int        |
| client_id      | int        |
| first_name     | string     |
| last_name      | string     |
| relation       | string     |
| email          | string     |
| phone          | string     |
| address        | string     |
| address_city   | string     |
| address_zip    | string     |
| address_state  | string     |
| active_contact | bool       |

### DietRestriction
| Fields      | Field Type |
|:------------|:-----------|
| id          | int        |
| client_id   | int        |
| restriction | string     |
| active      | bool       |

### EmergencyContact
| Fields                 | Field Type |
|:-----------------------|:-----------|
| emergency\_contact\_id | int        |
| client_id              | int        |
| first_name             | string     |
| last_name              | string     |
| phone                  | string     |
| alternate_phone        | string     |
| active_contact         | bool       |

### Logging
| Fields    | Field Type |
|:----------|:-----------|
| id        | int        |
| timestamp | string     |
| message   | string     |

### MedicalAlert
| Fields    | Field Type |
|:----------|:-----------|
| id        | int        |
| client_id | int        |
| alert     | string     |
| active    | bool       |

### Medication
| Fields     | Field Type |
|:-----------|:-----------|
| id         | int        |
| client_id  | int        |
| medication | string     |
| dosage     | string     |
| frequency  | string     |
| time_taken | string     |
| active     | bool       |

### PhysicalLimitation
| Fields     | Field Type |
|:-----------|:-----------|
| id         | int        |
| client_id  | int        |
| limitation | string     |
| active     | bool       |

## Endpoint

### Client
#### All Clients
GET [/api/clients](http://jacadevelopment.greenriverdev.com/api/clients)
Returns an array of Client Objects.
Ajax Example:
```ecmascript 6
$.ajax({
  url: '/api/clients',
  type: 'get',
  dataType: 'json',
  success: function (data) {
    //Do anything with the data
    let first_client = data[1];
    console.log('phone number = ' + first_client['phone']);
  }
});
```

#### Single Client
GET [/api/client/<client_id>](https://jacadevelopment.greenriverdev.com/api/client/1)
Returns the requested client.
Ajax Example:
```ecmascript 6
$.ajax({
  url: '/api/client/1',
  type: 'get',
  dataType: 'json',
  success: function (data) {
    //Do anything with the data
    let phone = data['phone'];
    console.log('phone number = ' + phone);
  }
});
```

##### Clients Contacts
GET [/api/client/<client_id>/contacts](https://jacadevelopment.greenriverdev.com/api/client/1/contacts)
Returns an array of the clients contacts.
Ajax Example:
```ecmascript 6
$.ajax({
  url: '/api/client/1/contacts',
  type: 'get',
  dataType: 'json',
  success: function (data) {
    //Do anything with the data
    for(let contact of data){
      console.log(contact['first_name'] + " " + contact['last_name']);
    }
  }
});
```

##### Clients Diet Restrictions
GET [/api/client/<client_id>/diet_restrictions](https://jacadevelopment.greenriverdev.com/api/client/1/diet_restrictions)
Returns an array of the clients diet restrictions.
Ajax Example:
```ecmascript 6
$.ajax({
  url: '/api/client/1/diet_restrictions',
  type: 'get',
  dataType: 'json',
  success: function (data) {
    //Do anything with the data
    for(let restriction of data){
      console.log(restriction['restriction']);
    }
  }
});
```

##### Clients Emergency Contacts
GET [/api/client/<client_id>/emergency_contacts](https://jacadevelopment.greenriverdev.com/api/client/1/emergency_contacts)
Returns an array of the clients emergency contacts.
Ajax Example:
```ecmascript 6
$.ajax({
  url: '/api/client/1/emergency_contact',
  type: 'get',
  dataType: 'json',
  success: function (data) {
    //Do anything with the data
    for(let contact of data){
      console.log(contact['first_name'] + " " + contact['last_name']);
    }
  }
});
```

##### Clients Medical Alerts
GET [/api/client/<client_id>/medical_alerts](https://jacadevelopment.greenriverdev.com/api/client/1/medical_alerts)
Returns an array of the clients medical alerts.
Ajax Example:
```ecmascript 6
$.ajax({
  url: '/api/client/1/medical_alert',
  type: 'get',
  dataType: 'json',
  success: function (data) {
    //Do anything with the data
    for(let alert of data){
      console.log(alert['alert']);
    }
  }
});
```

##### Clients Medications
GET [/api/client/<client_id>/medications](https://jacadevelopment.greenriverdev.com/api/client/1/medications)
Returns an array of the clients medications.
Ajax Example:
```ecmascript 6
$.ajax({
  url: '/api/client/1/medications',
  type: 'get',
  dataType: 'json',
  success: function (data) {
    //Do anything with the data
    for(let medication of data){
      console.log(medication['medication']);
    }
  }
});
```

##### Clients Physical Limitations
GET [/api/client/<client_id>/physical_limitations](https://jacadevelopment.greenriverdev.com/api/client/1/physical_limitations)
Returns an array of the clients physical limitations.
Ajax Example:
```ecmascript 6
$.ajax({
  url: '/api/client/1/physical_limitation',
  type: 'get',
  dataType: 'json',
  success: function (data) {
    //Do anything with the data
    for(let limitation of data){
      console.log(limitation['limitation']);
    }
  }
});
```
