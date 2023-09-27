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

### `patch($id, $data)`

- *Description:* Update an existing construction stage by ID.
- *Return Type:* `array`
- *Parameters:*
  - `$id` (int): The ID of the construction stage to update.
  - `$data` (ConstructionStagesPatch): The data to update the construction stage.

### `delete($id)`

- *Description:* Delete a construction stage by ID.
- *Return Type:* `array`
- *Parameters:*
  - `$id` (int): The ID of the construction stage to delete.

## ConstructionStagesCreate Class

- *Description:* This class represents the data structure for creating a new construction stage.

## ConstructionStagesPatch Class

- *Description:* This class represents the data structure for patching an existing construction stage.