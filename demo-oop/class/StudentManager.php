<?php


class StudentManager
{
    protected $listStudent = [];
    protected $filePath;
    public $arrsearch = [];

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function add($student)
    {
        $data = [
            "name" => $student->getName(),
            "email" => $student->getEmail(),
            "phone" => $student->getPhone()
        ];
        $students = $this->getDataJson();
        var_dump($students);
        array_push($students, $data);
        $this->saveDataToFile($students);
    }

    public function getStudents()
    {
        $data = $this->getDataJson();

        foreach ($data as $obj) {
            $student = new Student($obj->name, $obj->email, $obj->phone);
            array_push($this->listStudent, $student);
        }
        return $this->listStudent;
    }

    public function getDataJson()
    {
        $dataJson = file_get_contents($this->filePath);
        return json_decode($dataJson);
    }

    public function saveDataToFile($data)
    {
        $dataJson = json_encode($data);
        file_put_contents($this->filePath, $dataJson);
    }

    public function getStudentsByIndex($index)
    {
        $data = $this->getDataJson();// du lieu lay ra la 1 mang
        $obj = $data[$index];
        return new Student($obj->name, $obj->email, $obj->phone);
    }

    public function updateStudent($index, $student)
    {
        $data = $this->getDataJson();// du lieu lay ra la 1 man
        $arr = [
            "name" => $student->getName(),
            "email" => $student->getEmail(),
            "phone" => $student->getPhone()
        ];
        $data[$index] = $arr;
        $this->saveDataToFile($data);
    }

    public function deleteStudent($index)
    {
        $data = $this->getDataJson();
        array_splice($data, $index, 1);
        $this->saveDataToFile($data);

    }

    public function getKeyword($keyword)
    {
        $data = $this->getDataJson();
        foreach ($data as $obj) {
            if ($obj->name == $keyword) {
                $student = new Student($obj->name, $obj->email, $obj->phone);
                array_push($this->arrsearch, $student);
            }
        }
        return $this->arrsearch;
    }
}