<?php 
    $config = new stdClass;
    $config->name = htmlspecialchars($_POST["student_name"]);
    $config->language = htmlspecialchars($_POST["project_language"]);
    $config->project_title =  htmlspecialchars($_POST["project_name"]);
    $config->project_num =  htmlspecialchars($_POST["project_num"]);
    $config->soft_copy_due_date  = htmlspecialchars($_POST["soft_copy_deadline"]);
    $config->hard_copy_due_date =  htmlspecialchars($_POST["hard_copy_deadline"]);
    $config->output_files = array();
    $config->input_files =  array();
    $config->source_code_file = new stdClass;
    $config->source_code_file->path = $_FILES["source_code_file"]["tmp_name"];
    $config->source_code_file->name = $_FILES["source_code_file"]["name"];
    $config->output= $config->name . "Project" . $config->project_num . " - " .  $config->project_title;
    $numInputs = count($_FILES["input_files"]["tmp_name"]);
    for($i = 0; $i < $numInputs; $i++) {
        $inputFile = new stdClass;
        $inputFile->path = $_FILES["input_files"]["tmp_name"][$i];
        $inputFile->name = $_FILES["input_files"]["name"][$i];
        array_push($config->input_files, $inputFile);
    }
    $numOutputs = count($_FILES["output_files"]["tmp_name"]);
    for($i = 0; $i < $numOutputs; $i++) {
        $outputFile = new stdClass;
        $outputFile->path = $_FILES["output_files"]["tmp_name"][$i];
        $outputFile->name = $_FILES["output_files"]["name"][$i];
        array_push($config->output_files, $outputFile);
    }
    if($_POST["algorithm_step_choice"] == "internal") {
        $config->algorithm_steps = $_POST["algorithm_steps_text"];
    } else {
        $config->algorithm_steps = file_get_contents($_FILES["algorithm_step_file"]["tmp_name"]);
    }
    $configFileName = tempnam(sys_get_temp_dir(), "conf");
    $configFile = fopen($configFileName, "w");
    fwrite($configFile, json_encode($config));
    fclose($configFile);
    $filename = shell_exec("python3 ../python/report_generator.py " . $configFileName);
    header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=" . $filename); 
    header('Content-Length: ' . filesize($filename));
    readfile($filename);
    unlink($filename);
?>