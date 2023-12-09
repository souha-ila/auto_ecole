<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel API Routes


## API Routes
## API Routes

### 1. List of Véhicules

- **Route:** `GET /api/vehicules`
- **Description:** Retrieve a list of all véhicules.

### 2. Retrieve Véhicule by ID

- **Route:** `GET /api/vehicules/{id}`
- **Description:** Retrieve details of a véhicule based on its ID.

### 3. Create a New Véhicule

- **Route:** `POST /api/vehicules`
- **Description:** Create a new véhicule.
- **Parameters:** 
  - `modele` 
  - `matricule` 
  - `marque` 
  - `couleur`
  - `autoEcole_id`
  - `permis_id`

### 4. Update Véhicule

- **Route:** `PUT /api/vehicules/{id}`
- **Description:** Update details of a véhicule based on its ID.

### 5. Delete Véhicule

- **Route:** `DELETE /api/vehicules/{id}`
- **Description:** Delete a véhicule based on its ID.

### 6. Véhicules of AutoEcole

- **Route:** `GET /api/vehicules/autoecole/{autoecole_id}`
- **Description:** Retrieve a list of véhicules associated with a specific AutoEcole.

### 7. Véhicules of Permis

- **Route:** `GET /api/vehicules/permis/{permis_id}`
- **Description:** Retrieve a list of véhicules associated with a specific Permis.
