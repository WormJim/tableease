<?php 

// Sujects Table Query Functions

    function find_all_subjects() {
        global $db;
        
        $sql = "SELECT * FROM subjects ";
        $sql .= "ORDER BY position ASC";
        // echo $sql;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }
    
    function find_subject_by_id($id) {
        global $db;
        
        $sql = "SELECT * FROM subjects ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $subject;
    }

    function validate_subject($subject) {

        $errors = [];
        
        // menu_name
        if(is_blank($subject['menu_name'])) {
          $errors[] = "Name cannot be blank.";
        } elseif(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
          $errors[] = "Name must be between 2 and 255 characters.";
        }
      
        // position
        // Make sure we are working with an integer
        $postion_int = (int) $subject['position'];
        if($postion_int <= 0) {
          $errors[] = "Position must be greater than zero.";
        }
        if($postion_int > 999) {
          $errors[] = "Position must be less than 999.";
        }
      
        // visible
        // Make sure we are working with a string
        $visible_str = (string) $subject['visible'];
        if(!has_inclusion_of($visible_str, ["0","1"])) {
          $errors[] = "Visible must be true or false.";
        }
      
        return $errors;
    }

    function insert_subject($subject) {
        global $db;

        $errors = validate_subject($subject); //The array of all errors
        if(!empty($errors)) { //if the array of erros has no errors
            return $errors;
        }

        $sql = "INSERT INTO subjects ";
        $sql .= "(menu_name, position, visible) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $subject['menu_name']) . "', ";
        $sql .= "'" . db_escape($db, $subject['position']) . "', ";
        $sql .= "'" . db_escape($db, $subject['visible']) . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function update_subject($subject) {
        global $db;

        $errors = validate_subject($subject); //The array of all errors
        if(!empty($errors)) { //if the array of erros has no errors
            return $errors;
        }

        $sql = "UPDATE subjects SET ";
        $sql .= "menu_name='" . db_escape($db, $subject['menu_name']) . "', ";
        $sql .= "position='" . db_escape($db, $subject['position']) . "', ";
        $sql .= "visible='" . db_escape($db, $subject['visible']) . "' ";
        $sql .= "WHERE id='" . db_escape($db, $subject['id']) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
            } else {
                echo mysqli_error($db);
                db_disconnect($db);
                exit;
            }
        return $subject;
    }

    function delete_subject($id) {
        
        

        global $db;
        
        $sql = "DELETE FROM subjects ";
        $sql .="WHERE id='" . db_escape($db, $id) . "' ";
        $sql .="LIMIT 1";

        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }


// Page Table Query Functions

    function pages_find_all() {
        global $db;
        
        $sql = "SELECT * FROM pages ";
        $sql .= "ORDER BY subject_id ASC, position ASC";
        // echo $sql;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function page_find_by_id($id) {
        global $db;
        
        $sql = "SELECT * FROM pages ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $page = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $page;
    }

    function page_validate($page) {

        $errors = [];
        
        // menu_name
        if (is_blank($page['menu_name'])) {
          $errors[] = "Page name cannot be blank.";
        } elseif (!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
          $errors[] = "Page name must be between 2 and 255 characters.";
        }
        $current_id = $page['id'] ?? '0';
        if(!has_unique_page_menu_name($page['menu_name'], $current_id)) {
            $errors[] = "Page name must be unique.";
        }
        
        // subject_id
        // Make sure subject_name has content and within lenght requirement
        if (is_blank($page['subject_id'])) {
            $errors[] = "Subject name cannot be blank";
        }

        // position
        // Make sure we are working with an integer
        $postion_int = (int) $page['position'];
        if ($postion_int <= 0) {
          $errors[] = "Position must be greater than zero.";
        }
        if ($postion_int > 999) {
          $errors[] = "Position must be less than 999.";
        }
      
        // visible
        // Make sure we are working with a string
        $visible_str = (string) $page['visible'];
        if (!has_inclusion_of($visible_str, ["0","1"])) {
          $errors[] = "Visible must be true or false.";
        }
      
         // content
         if(is_blank($page['content'])) {
             $errors[] = "Conent cannot be blank.";
         }
         
        return $errors;

    }

    function page_insert($page) {
        global $db;
        
        $errors = page_validate($page);
        if (!empty($errors)) {
            return $errors;
        }

        $sql = "INSERT INTO pages ";
        $sql .= "(menu_name, subject_id, position, visible, content) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $page['menu_name']) . "',";
        $sql .= "'" . db_escape($db, $page['subject_id']) . "',";
        $sql .= "'" . db_escape($db, $page['position']) . "',";
        $sql .= "'" . db_escape($db, $page['visible']) . "',";
        $sql .= "'" . db_escape($db, $page['content']) . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);
        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function page_update_by_id($page) {
        global $db;

        $errors = page_validate($page);
        if (!empty($errors)) {
            return $errors;
        }

        $sql = "UPDATE pages SET ";
        $sql .= "subject_id='" . db_escape($db, $page['subject_id']) . "', ";        
        $sql .= "menu_name='" . db_escape($db, $page['menu_name']) . "', ";
        $sql .= "position='" . db_escape($db, $page['position']) . "', ";
        $sql .= "visible='" . db_escape($db, $page['visible']) . "', ";
        $sql .= "content='" . db_escape($db, $page['content']) . "' ";
        $sql .= "WHERE id='" . db_escape($db, $page['id']) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
            } else {
                echo mysqli_errno($db);
                echo mysqli_error($db);
                db_disconnect($db);
                exit;
            }
        return $pages;
    }

    function page_delete($id) {
        global $db;
        
        $sql = "DELETE FROM pages ";
        $sql .="WHERE id='" . db_escape($db, $id) . "' ";
        $sql .="LIMIT 1";

        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }


// Contact Table Query Functions

    function insert_contact($contact) {
        global $db;
        
        $errors = contact_validate($contact);
        if (!empty($errors)) {
            return $errors;
        }

        $sql = "INSERT INTO contact ";
        $sql .= "(firstName, lastName, email) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $contact['firstName']) . "',";
        $sql .= "'" . db_escape($db, $contact['lastName']) . "',";
        $sql .= "'" . db_escape($db, $contact['email']) . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);
        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function contact_validate($contact) {

        $errors = [];
        
        // First Name
        if (is_blank($contact['firstName'])) {
            $errors[] = "Your first name cannot be blank.";
        } elseif (!has_length($contact['firstName'], ['min' => 2, 'max' => 16])) {
            $errors[] = "Your first name must be between 2 and 16 characters.";
        }
        
        // Last Name
        if (is_blank($contact['lastName'])) {
            $errors[] = "Your last name cannot be blank.";
        } elseif (!has_length($contact['lastName'], ['min' => 2, 'max' => 32])) {
            $errors[] = "Your last name must be between 2 and 16 characters.";
        }

        // Email
        if (is_blank($contact['email'])) {
            $errors[] = "Your email address cannot be blank.";
        } elseif (!has_valid_email_format($contact['email'])) {
            $errors[] = "Please provide a proper email address format";
        }
        
        return $errors;
    }



// Restaurant Table Query Functions

    function find_all_restaurants() {
        global $db;
        
        $sql = "SELECT * FROM restaurants ";
        $sql .= "ORDER BY restaurant ASC";
        // echo $sql;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_restaurant_by_id($id) {
        global $db;
        
        $sql = "SELECT * FROM restaurants ";
        $sql .= "WHERE id = '" . db_escape($db, $id) . "' ";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $restaurant = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $restaurant;
    }


// Menu Table Query Functions

    function find_menu_by_restaurant_id($id) {
        global $db;

        $sql = "SELECT menu_item, sub_item, description, courses_id  FROM menus ";
        $sql .= "WHERE restaurant_id = '" . db_escape($db, $id) . "' " ;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        
        return $result;
    }   

// Courses Table Query Functions
    
    function find_all_courses() {
        global $db;
        
        $sql = "SELECT * FROM courses ";
        $sql .= "ORDER BY id ASC";
        
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        
        return $result;
    }

    function find_course_by_id($id){
        global $db;

        $sql = "SELECT * FROM courses ";
        $sql .= "WHERE id = '" . db_escape($db, $id) . "' ";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        $course = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        return $course;
    }

// User Table Query Functions

    

// Pass User Table Query Functions

    function create_new_user($user) {
        global $db;

        $errors = validate_new_user($user);
        if(!empty($errors)) {
            return $errors;
        }

        $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO upass_user ";
        $sql .= "(first_name, last_name, email, username, hashed_password) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $user['first_name']) . "', ";
        $sql .= "'" . db_escape($db, $user['last_name']) . "', ";
        $sql .= "'" . db_escape($db, $user['email']) . "', ";
        $sql .= "'" . db_escape($db, $user['username']) . "', ";
        $sql .= "'" . db_escape($db, $hashed_password) . "'";
            // TODO
            // if new user is Admin
            // if new user is owner
        $sql .= ")";
        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect();
            exit;
        }
    }

    function validate_new_user($user, $option=[]) {

        $errors = [];

        $password_required = $options['password_required'] ?? true;
        
        // first_name
        if (is_blank($user['first_name'])) {
          $errors[] = "Your first name cannot be blank.";
        } elseif (!has_length($user['first_name'], ['min' => 2, 'max' => 255])) {
          $errors[] = "Your first name must be between 2 and 255 characters.";
        }

        // last_name
        if (is_blank($user['last_name'])) {
          $errors[] = "Your last name cannot be blank.";
        } elseif (!has_length($user['last_name'], ['min' => 2, 'max' => 255])) {
          $errors[] = "Your last name must be between 2 and 255 characters.";
        }

        // email
        if(is_blank($user['email'])) {
            $errors[] = "Email cannot be left blank.";
        } elseif(!has_length($user['email'], ['min' => 8, 'max' => 255])) {
            $errors[] = "Email must be a in valid email format.";
        } elseif(!has_valid_email_format($user['email'])) {
            $errors[] = "Email must be a in valid email format.";            
        }
      
        // username
        if(is_blank($user['username'])) {
            $errors[] = 'Username cannot be left blank.';
        } elseif(!has_length($user['username'], ['min' => 8, 'max' => 255])) {
            $errors[] = "Username should be between 8 and 255 characters.";
        }elseif (!user_has_unique_username($user['username'], $user['id'] ?? 0)) {
            $errors[] = 'Username not allowed, please choose a different Username.';
        }
      
        if($password_required) {
            if(is_blank($user['password'])) {
                $errors[] = 'Password cannot be left blank.';
            } elseif(!has_length($user['password'], ['min' => 10])) {
                $errors[] = "Password must contain 10 or more characters.";
            } elseif (!preg_match('/[A-Z]/', $user['password'])) {
                $errors[] = "Password must contain at least 1 uppercase letter.";
            } elseif (!preg_match('/[a-z]/', $user['password'])) {
                $errors[] = "Password must contain at least 1 lowercase letter.";
            } elseif (!preg_match('/[0-9]/', $user['password'])) {
                $errors[] = "Password must contain at least 1 number.";
            } elseif (!preg_match('/[^A-Za-z0-9\s]/', $user['password'])) {
                $errors[] = "Password must contain at least 1 symbol.";
            }

            // Confrim password
            if(is_blank($user['confirm_password'])) {
                $errors[] = "You must confirm your password.";
            } elseif ($user['password'] !== $user['confirm_password']) {
                $errors[] = "Passwords do not match."; 
            }
        }
         
        return $errors;
    }

    function find_user_by_id($id) {
        global $db;

        $sql = "SELECT * FROM upass_user ";
        $sql .= "LIMIT 1";
        
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        
        return $result;
    }
?>