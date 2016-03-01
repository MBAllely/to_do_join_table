<?php
    class Task
    {
        private $id;
        private $description;
        private $due_date;
        private $completed;

        function __construct($id = null, $description, $due_date, $completed = false)
        {
            $this->id = $id;
            $this->description = $description;
            $this->due_date = $due_date;
            $this->completed = $completed;
        }

        function getId()
        {
            return $this->id;
        }

        function getDescription()
        {
            return $this->description;
        }

        function getDueDate()
        {
            return $this->due_date;
        }

        function getCompleted()
        {
            return $this->completed;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function setDueDate($new_due_date)
        {
            $this->due_date = $new_due_date;
        }

        function setCompleted($is_done)
        {
            $this->completed = $is_done;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO tasks (description, due_date, completed) VALUES ('{$this->getDescription()}', '{$this->getDueDate()}', '{$this->getCompleted()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
            $tasks = array();
            foreach($returned_tasks as $task) {
                $description = $task['description'];
                $id = $task['id'];
                $due_date = $task['due_date'];
                $completed = $task['completed'];
                $new_task = new Task($id, $description, $due_date, $completed);

                array_push($tasks, $new_task);
            }
            return $tasks;
        }

        function addCategory($category)
        {
            $GLOBALS['DB']->exec("INSERT INTO categories_tasks (category_id, task_id) VALUES ({$category->getId()}, {$this->getId()});");
        }

        function getCategories()
        {
            $query = $GLOBALS['DB']->query("SELECT category_id FROM categories_tasks WHERE task_id = {$this->getId()};");
            $category_ids = $query->fetchAll(PDO::FETCH_ASSOC);

            $categories = array();
            foreach($category_ids as $id) {
                $category_id = $id['category_id'];
                $result = $GLOBALS['DB']->query("SELECT * FROM categories WHERE id = {$category_id};");
                $returned_category = $result->fetchAll(PDO::FETCH_ASSOC);

                $name = $returned_category[0]['name'];
                $id = $returned_category[0]['id'];
                $new_category = new Category($name, $id);
                array_push($categories, $new_category);
            }
            return $categories;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM tasks;");
        }

        static function find($search_id)
        {
            $found_task = null;
            $tasks = Task::getAll();
            foreach($tasks as $task) {
                $task_id = $task->getId();
                if ($task_id == $search_id) {
                  $found_task = $task;
                }
            }
            return $found_task;
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM tasks WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM categories_tasks WHERE task_id = {$this->getId()};");
        }
    }
?>
