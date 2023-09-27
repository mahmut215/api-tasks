<?php

class ConstructionStages {

    private $db;

    public function __construct() {
        $this->db = Api::getDb();
    }

    public function getAll() {
        $stmt = $this->db->prepare("
			SELECT
				ID as id,
				name, 
				strftime('%Y-%m-%dT%H:%M:%SZ', start_date) as startDate,
				strftime('%Y-%m-%dT%H:%M:%SZ', end_date) as endDate,
				duration,
				durationUnit,
				color,
				externalId,
				status
			FROM construction_stages
		");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSingle($id) {
        $stmt = $this->db->prepare("
			SELECT
				ID as id,
				name, 
				strftime('%Y-%m-%dT%H:%M:%SZ', start_date) as startDate,
				strftime('%Y-%m-%dT%H:%M:%SZ', end_date) as endDate,
				duration,
				durationUnit,
				color,
				externalId,
				status
			FROM construction_stages
			WHERE ID = :id
		");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

///////
    // Inside the ConstructionStages class, add a method to calculate duration
    private function calculateDuration($start_date, $end_date, $durationUnit) {
        // Calculate duration in hours
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        $interval = $start->diff($end);
        $durationInHours = $interval->days * 24 + $interval->h;

        // Convert duration to the specified unit (default is DAYS)
        switch ($durationUnit) {
            case 'HOURS':
                return $durationInHours;
            case 'WEEKS':
                return $durationInHours / 24 / 7;
            default:
                return $durationInHours / 24; // DAYS is the default
        }
    }

    ////
    public function post(ConstructionStagesCreate $data) {
        Validation::validateFields($data);
        // Calculate the duration
        $data->duration = $this->calculateDuration($data->startDate, $data->endDate, $data->durationUnit);

        $stmt = $this->db->prepare("
			INSERT INTO construction_stages
			    (name, start_date, end_date, duration, durationUnit, color, externalId, status)
			    VALUES (:name, :start_date, :end_date, :duration, :durationUnit, :color, :externalId, :status)
			");
        $stmt->execute([
            'name' => $data->name,
            'start_date' => $data->startDate,
            'end_date' => $data->endDate,
            'duration' => $data->duration,
            'durationUnit' => $data->durationUnit,
            'color' => $data->color,
            'externalId' => $data->externalId,
            'status' => $data->status,
        ]);
        return $this->getSingle($this->db->lastInsertId());
    }

    public function patch($id) {
        $data = json_decode(file_get_contents('php://input'));

        // Validate the status field if it's sent
        if (isset($data->status) && !in_array($data->status, ['NEW', 'PLANNED', 'DELETED'])) {
            return ['error' => 'Invalid status'];
        }

        $fieldsToUpdate = [];
        if (isset($data->name)) {
            $fieldsToUpdate['name'] = $data->name;
        }
        // Add other fields you want to allow editing here
        // Build and execute the SQL query to update the fields
        $updateQuery = "UPDATE construction_stages SET ";
        $params = [];
        foreach ($fieldsToUpdate as $field => $value) {
            $updateQuery .= "$field = :$field, ";
            $params[":$field"] = $value;
        }
        $updateQuery = rtrim($updateQuery, ', ') . " WHERE ID = :id";
        $params[':id'] = $id;

        $stmt = $this->db->prepare($updateQuery);
        $stmt->execute($params);

        return $this->getSingle($id);
    }

    public function delete($id) {

        // Update the status to DELETED
        $stmt = $this->db->prepare("UPDATE construction_stages SET status = 'DELETED' WHERE ID = :id");
        $stmt->execute([':id' => $id]);

        return ['message' => 'Construction stage deleted'];
    }

}
