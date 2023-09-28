# API Methods Documentation

In this document, you'll find the documentation for all the methods that have been added to the API.

## ConstructionStages Class

### `getAll()`

- *Description:* Get all construction stages.
- *Return Type:* `array`
- *Parameters:* None

### `getSingle($id)`

- *Description:* Get a single construction stage by ID.
- *Return Type:* `array`
- *Parameters:*
  - `$id` (int): The ID of the construction stage.

### `post($data)`

- *Description:* Create a new construction stage.
- *Return Type:* `array`
- *Parameters:*
  - `$data` (ConstructionStagesCreate): The data for the new construction stage.

### `patch($id)`

- *Description:* Update an existing construction stage by ID.
- *Return Type:* `array`
- *Parameters:*
  - `$id` (int): The ID of the construction stage to update.

### `delete($id)`

- *Description:* Delete a construction stage by ID.
- *Return Type:* `array`
- *Parameters:*
  - `$id` (int): The ID of the construction stage to delete.

## ConstructionStagesCreate Class

- *Description:* This class represents the data structure for creating a new construction stage.

## ConstructionStagesPatch Class

- *Description:* This class represents the data structure for patching an existing construction stage.

  # Validation Class Documentation

The `Validation` class provides methods for validating various data fields.

## Table of Contents

- [Methods](#methods)
  - [`validateFields($data)`](#validatefieldsdata)
  - [`isValidDateTime($dateTime)`](#isvaliddatetimedatetime)
  - [`isValidHexColor($color)`](#isvalidhexcolorcolor)
  - [`isValidIso8601Date($date)`](#isvalidiso8601datedate)

## Methods

### `validateFields($data)`

This method validates the fields in the provided data object.

- `data` (object): The data object containing fields to be validated.

#### Field Validations

- `name`: Checks if it's not longer than 255 characters.
- `startDate`: Validates the date format (ISO8601) using `isValidDateTime()`.
- `end_date`: Validates the date format (ISO8601) using `isValidIso8601Date()` and checks if end date is later than the start date.
- `durationUnit`: Checks if it's one of `HOURS`, `DAYS`, or `W

