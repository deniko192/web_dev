<?php
header('Content-Type: text/plain');

class Survey
{
    protected ?string $email, $first_name, $last_name, $age;
    protected $params = array(
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'age' => 'Age',
    );

    function get()
    {
        $data = array();
        foreach ($this->params as $key => $_) 
        {
            $data[$key] = $this->{$key};
        }
        return $data;
    }

    function getParams()
    {
        return $this->params;
    }

    function update($key, $value)
    {
        $this->{$key} = $value;
    }
}

class RequestSurveyLoader extends Survey
{
    private function _getGetParam($name)
    {
        return isset($_GET[$name]) ? $_GET[$name] : null;  
    }

    public function __construct()
    {
        foreach ($this->params as $key => $_) {
            $this->{$key} = $this->_getGetParam($key);
        }
    }
}

class SurveyFileStorage
{
    private array $survey = array();
    private $fileName;
    private $params;

    public function __construct($survey)
    {
        $this->survey = $survey->get();
        $this->params = $survey->getParams();
        $this->fileName = './data/' . $this->survey['email'] . '.txt';
    }

    public function update($key, $value)
    {
        $this->survey[$key] = $value;
    }

    public function save()
    {
        if ($this->survey['email'] === null)
        {
            echo 'Empty email value';
        }
        else 
        {
            $data = '';
            foreach ($this->survey as $key => $value) 
            {
                $data = $data . $this->params[$key] . ': ' . $value . PHP_EOL; 
            }
            $fileStatus = file_put_contents($this->fileName, $data);
            echo $fileStatus === false ? 'Save error' : 'File saved';
        }
    }

    public function load()
    {
        if (file_exists($this->fileName))
        {
            $lines = file($this->fileName);
            $user = array();
            foreach ($lines as $line)
            {
                $value = explode(": ", $line, 2);
                $user[$value[0]] = trim($value[1]);
            }
            return $user;
        }
        return null;
    }
}

class SurveyPrinter
{
    public function print($survey)
    {
        $params = $survey->getParams();
        $data = $survey->get();
        echo PHP_EOL . '-------' . PHP_EOL;
        foreach ($data as $key => $value) {
            echo $params[$key] . ': ' . $value . PHP_EOL;
        }
    }
}

$survey = new RequestSurveyLoader();
$surveyFile = new SurveyFileStorage($survey);
$surveyPrinter = new SurveyPrinter();

$data = $surveyFile->load();
if ($data)
{
    $newData = $survey->get();
    $params = $survey->getParams();
    foreach ($newData as $key => $value) {
        $newValue = $value ?? $data[$params[$key]];
        $surveyFile->update($key, $newValue);
        $survey->update($key, $newValue);
    }
}
$surveyFile->save();
$surveyPrinter->print($survey);
