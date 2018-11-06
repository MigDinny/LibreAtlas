# REST API Guide

This API allows anyone with authorization to manage markers from the Atlas.

Keep in mind that this is always in constant change/improvement and this information may not be fully updated when you read it.

## How to use?

1. A software is required to send and receive HTTP Requests. You can make yours (for example in Python) or use Postman or other kind of software.
2. You need an API Key to access this API. Only an administrator can give you one. It authenticates you to the API which gives you direct access to markers.


## API Structure

A POST request must be made to this kind of URL (it can be different depending on the domain, server and folder in which the app is installed):

`localhost/libreatlas/?area=api&api_key=<YOUR_API_KEY>&action=<DESIRED_FUNCTION>`
(<> chars must not be included)

All functions require POST parameters as described below.
The required POST parameters are described like they were JSON key-pair values.
The response will be "success" or "error" in plain-text.

3 main functions (their names are case-insensitive, just replace them in the link as well as the API Key):

* `addmarker` >> you can add a marker with this function. POST parameters ARE REQUIRED.

```
{
  latlng: '40.203, -8.314134', // FIELD REQUIRED: COORDINATES
  distribution: 'LibreEHR v2.0.0', // DISTRIBUTION BEING USED
  event: 'Alien Virus', // RELATED EVENT
  facility: 'Planet Earth', // FACILITY (clinic name for example, not necessarily a planet)
  number_patients: '10', // NUMBER OF PATIENTS
  website: 'www.example.com', // FACILITY'S WEBSITE (DO NOT write the protocol before!)
  contacts: 'email@example.com' // CONTACTS (can be a phone number, etc)
}
```

* `disablemarker` >> you can disable a marker with this function. It will be marked as disabled but will always be on DB. POST parameters ARE REQUIRED.

```
{
  marker_id: '1' // THE MARKER ID WHICH IS GOING TO BE DISABLED (this id can be found in atlas map)
}
```

* `enablemarker` >> you can enable a marker which was previously disabled. It will be back like it was never deleted!

```
{
  marker_id: '1' // THE MARKER ID WHICH IS GOING TO BE ENABLED (this id can be found in atlas map)
}
```
