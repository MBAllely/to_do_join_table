<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Category.php";
    require_once "src/Task.php";

    $server = 'mysql:host=localhost;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CategoryTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Category::deleteAll();
            Task::deleteAll();
        }
        //
        // function test_getName()
        // {
        //     $name = "Work stuff";
        //     $test_Category = new Category($name);
        //
        //     $result = $test_Category->getName();
        //
        //     $this->assertEquals($name, $result);
        // }
        //
        // function test_getId()
        // {
        //     $name = "Work stuff";
        //     $id = 1;
        //     $test_Category = new Category($name, $id);
        //
        //     $result = $test_Category->getId();
        //
        //     $this->assertEquals(true, is_numeric($result));
        // }
        //
        // function test_save()
        // {
        //     $name = "Work stuff";
        //     $test_Category = new Category($name);
        //     $test_Category->save();
        //
        //     $result = Category::getAll();
        //
        //     $this->assertEquals($test_Category, $result[0]);
        // }
        //
        // function test_getAll()
        // {
        //     $name = "Work stuff";
        //     $name2 = "Home stuff";
        //     $test_Category = new Category($name);
        //     $test_Category->save();
        //     $test_Category2 = new Category($name2);
        //     $test_Category2->save();
        //
        //     $result = Category::getAll();
        //
        //     $this->assertEquals([$test_Category, $test_Category2], $result);
        // }
        //
        // function test_deleteAll()
        // {
        //     $name = "Wash the dog";
        //     $name2 = "Home stuff";
        //     $test_Category = new Category($name);
        //     $test_Category->save();
        //     $test_Category2 = new Category($name2);
        //     $test_Category2->save();
        //
        //     Category::deleteAll();
        //     $result = Category::getAll();
        //
        //     $this->assertEquals([], $result);
        // }
        //
        // function test_find()
        // {
        //     $name = "Wash the dog";
        //     $name2 = "Home stuff";
        //     $test_Category = new Category($name);
        //     $test_Category->save();
        //     $test_Category2 = new Category($name2);
        //     $test_Category2->save();
        //
        //     $result = Category::find($test_Category->getId());
        //
        //     $this->assertEquals($test_Category, $result);
        // }
        //
        // // function testGetTasks()
        // // {
        // //     //Arrange
        // //     $name = "Work stuff";
        // //     $id = null;
        // //     $test_category = new Category($name, $id);
        // //     $test_category->save();
        // //
        // //     $test_category_id = $test_category->getId();
        // //
        // //     $description = "Email client";
        // //     $due_date = "2016-02-29";
        // //     $test_task = new Task($id, $description, $due_date);
        // //     $test_task->save();
        // //
        // //     $description2 = "Meet with boss";
        // //     $due_date2 = "2016-02-29";
        // //     $test_task2 = new Task($id, $description2, $due_date2);
        // //     $test_task2->save();
        // //
        // //     //Act
        // //     $result = $test_category->getTasks();
        // //
        // //     //Assert
        // //     $this->assertEquals([$test_task, $test_task2], $result);
        // // }
        //
        // function testAddTask()
        // {
        //     //Arrange
        //     $name = "Work stuff";
        //     $id = 1;
        //     $test_category = new Category($name, $id);
        //     $test_category->save();
        //
        //     $description = "File reports";
        //     $id2 = 2;
        //     $due_date = "2016-02-29";
        //     $completed = false;
        //     $test_task = new Task($id2, $description, $due_date, $completed);
        //     $test_task->save();
        //
        //     //Act
        //     $test_category->addTask($test_task);
        //
        //     //Assert
        //     $this->assertEquals($test_category->getTasks(), [$test_task]);
        // }

        function testGetTasks()
        {
            //Arrange
            $name = "Home stuff";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $id2 = 2;
            $due_date = "2016-02-29";
            $completed = true;
            $test_task = new Task($id2, $description, $due_date, $completed);
            $test_task->save();

            $description2 = "Take out the trash";
            $id3 = 3;
            $due_date2 = "2016-05-12";
            $completed2 = 0;
            $test_task2 = new Task($id3, $description2, $due_date2, $completed2);
            $test_task2->save();

            //Act
            $test_category->addTask($test_task);
            $test_category->addTask($test_task2);

            //Assert
            $this->assertEquals([$test_task, $test_task2], $test_category->getTasks());
        }

        // function test_delete()
        // {
        //     //Arrange
        //     $name = "Work Stuff";
        //     $id = 1;
        //     $test_category = new Category($name, $id);
        //     $test_category->save();
        //
        //     $description = "File reports";
        //     $id2 = 2;
        //     $due_date = "2016-02-29";
        //     $completed = false;
        //     $test_task = new Task($id2, $description, $due_date, $completed);
        //     $test_task->save();
        //
        //     //Act
        //     $test_category->addTask($test_task);
        //     $test_category->delete();
        //
        //     //Assert
        //     $this->assertEquals([], $test_task->getCategories());
        // }
    }

?>
