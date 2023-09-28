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

The `Validation` class is designed to validate various fields in a data object. This documentation provides an overview of the class, its methods, and how to use them.

## Table of Contents

1. [Overview](#overview)
2. [Methods](#methods)
   - [validateFields($data)](#validatefieldsdata)
   - [isValidDateTime($dateTime)](#isvaliddatetimedatetime)
   - [isValidHexColor($color)](#isvalidhexcolorcolor)
   - [isValidIso8601Date($date)](#isvalidiso8601datedate)
3. [Usage Examples](#usage-examples)
4. [License](#license)

## Overview

The `Validation` class provides a set of methods for validating common data fields such as names, dates, colors, and more. It can be used to ensure that data conforms to specific criteria before processing it further.

## Methods

### `validateFields($data)`

This method validates the fields in the provided data object. It checks the following fields and adds error messages to an array for each validation failure:

- `name`: Checks if the name is not longer than 255 characters.
- `startDate`: Validates the date and time format (ISO8601) and checks if it's a valid date and time.
- `end_date`: Validates the date and time format (ISO8601) and checks if it's a valid date and time, as well as if the end date is later than the start date.
- `durationUnit`: Checks if the duration unit is one of `HOURS`, `DAYS`, or `WEEKS`.
- `color`: Validates the color format as a HEX color code.
- `externalId`: Checks if the external ID is not longer than 255 characters.
- `status`: Checks if the status is one of `NEW`, `PLANNED`, or `DELETED`.

If there are validation errors, it returns a JSON response with error messages.

### `isValidDateTime($dateTime)`

This method checks if a given date and time string is a valid date and time. It returns `true` if the input is a valid date and time, otherwise `false`.

### `isValidHexColor($color)`

This method checks if a given string is a valid HEX color code. It returns `true` if the input is a valid HEX color, otherwise `false`.

### `isValidIso8601Date($date)`

This method checks if a given date string follows the ISO8601 format. It returns `true` if the input is a valid ISO8601 date, otherwise `false`.

## Usage Examples

Here are some usage examples of the `Validation` class:

```php
// Example 1: Validating data
$data = (object) [
    'name' => 'John Doe',
    'startDate' => '2022-12-31T14:59:00Z',
    // Include other fields here
];

Validation::validateFields($data);

// Example 2: Checking if a date is valid
$date = '2022-12-31T14:59:00Z';
$isValid = Validation::isValidIso8601Date($date);

// Example 3: Checking if a color is valid
$color = '#FF0000';
$isValidColor = Validation::isValidHexColor($color);
