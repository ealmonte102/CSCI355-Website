<?php 
    function var_dump_pre($mixed = null) {
        echo '<pre>';
        var_dump($mixed);
        echo '</pre>';
        return null;
    }

    function recursivePrint(DOMNode $domNode, $currentIndentation, $stepNumber, &$destination) {
        if($domNode->childNodes == null) {
            for($i = 0; $i < $currentIndentation; $i++) {
                $destination .= ' ';
            }
            $destination .= $stepNumber . ')';
            $destination .= $domNode->textContent;
            $destination .= PHP_EOL;
        } else {
            recursivePrint($domNode->childNodes[0], $currentIndentation, $stepNumber, $destination);
            for($i = 1; $i < $domNode->childNodes->length; $i++) {
                recursivePrint($domNode->childNodes[$i], $currentIndentation + 4, $stepNumber . '.' . $i, $destination);
            }
        }
    }

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
        $doc = new DOMDocument();
        $doc->loadHTML($_POST["algorithm_steps_text"], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        for($i = 0; $i < $doc->firstChild->childNodes->length; ++$i) {
            recursivePrint($doc->firstChild->childNodes[$i], 0, $i + 1, $config->algorithm_steps);
        }
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