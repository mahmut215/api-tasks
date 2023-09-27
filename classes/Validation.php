
<?php
class Validation
{
    public static function validateFields($data)
    {
        $errors = [];

        // Validate name
        if (isset($data->name) && strlen($data->name) > 255) {
            $errors['name'] = 'Name must be a maximum of 255 characters in length.';
        }

       
// Validate start_date
        
        if (isset($data->startDate) && !self::isValidDateTime($data->startDate)) {
            $errors['start_date'] = 'Invalid start date format. Use ISO8601 format (e.g., 2022-12-31T14:59:00Z).';
        }

        // Validate end_date
        if (isset($data->end_date) && !self::isValidIso8601Date($data->end_date)) {
            $errors['end_date'] = 'Invalid end date format. Use ISO8601 format (e.g., 2022-12-31T14:59:00Z).';
        } elseif (isset($data->start_date) && isset($data->end_date) && strtotime($data->start_date) > strtotime($data->end_date)) {
            $errors['end_date'] = 'End date must be later than the start date.';
        }

        // Validate durationUnit
        $validDurationUnits = ['HOURS', 'DAYS', 'WEEKS'];
        if (isset($data->durationUnit) && !in_array($data->durationUnit, $validDurationUnits)) {
            $errors['durationUnit'] = 'Invalid duration unit. Use one of HOURS, DAYS, WEEKS.';
        }

        // Validate color
        if (isset($data->color) && !self::isValidHexColor($data->color)) {
            $errors['color'] = 'Invalid color format. Use a valid HEX color (e.g., #FF0000).';
        }

        // Validate externalId
        if (isset($data->externalId) && strlen($data->externalId) > 255) {
            $errors['externalId'] = 'External ID must be a maximum of 255 characters in length.';
        }

        // Validate status
        $validStatuses = ['NEW', 'PLANNED', 'DELETED'];
        if (isset($data->status) && !in_array($data->status, $validStatuses)) {
            $errors['status'] = 'Invalid status. Use one of NEW, PLANNED, DELETED.';
        }

        if (!empty($errors)) {
            $errorResponse = json_encode(['errors' => $errors]);
            echo $errorResponse;
            exit;
        }
    }

    private static function isValidIso8601Date($date)
    {
        return (bool) preg_match('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $date);
    }

    
    public static function isValidDateTime($dateTime)
    {
        return (bool) strtotime($dateTime);
    }

    public static function isValidHexColor($color)
    {
        return preg_match('/^#[a-fA-F0-9]{6}$/', $color);
    }
}