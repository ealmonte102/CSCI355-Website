<?php
function var_dump_pre($mixed = null) {
    echo '<pre>';
    var_dump($mixed);
    echo '</pre>';
    return null;
}

function recursivePrint(DOMNode $domNode, $level, $stepNumber, $recievedNumber, &$destination) {
    for ($i = 0; $i < $domNode->childNodes->length; $i++) {
        $child = $domNode->childNodes[$i];
        if ($child->nodeName == 'ol') {
            recursivePrint($child, $level + 1, $stepNumber, false, $destination);
        } else if ($stepNumber == null) {
            recursivePrint($child, $level, ($i + 1), true, $destination);
        } else if (!$recievedNumber) {
            recursivePrint($child, $level, $stepNumber . '.' . ($i + 1), true, $destination);
        } else {
            $modifiers = ["u" => false, "strong" => false];
            while ($child->childNodes != null && ($child->nodeName != "text" || $child->nodeName != "br")) {
                $modifiers["u"] = $child->nodeName == "u" || $modifiers["u"];
                $modifiers["strong"] = $child->nodeName == "strong" || $modifiers["strong"];
                $child = $child->firstChild;
            }
            if ($child->nodeName == "br") {
                continue;
            }
            for ($j = 0; $j < $level * 4; $j++) {
                $destination .= ' ';
            }
            if(ctype_digit(strval($stepNumber))) {
                $destination .= "Step ";
            }
            $destination .= $stepNumber . ') ';
            if ($modifiers["u"]) {
                $destination .=  '__';
            }
            if ($modifiers["strong"]) {
                $destination .=  '#';
            }
            $destination .=  $child->textContent;
            if ($modifiers["strong"]) {
                $destination .=  '#';
            }
            if ($modifiers["u"]) {
                $destination .=  '__';
            }
            $destination .=  PHP_EOL;
        }
    }
}

function recursivePrintHelper(DOMNode $domNode, &$destination)
{
    recursivePrint($domNode, 0, null, false, $destination);
}

function parseSteps(string $steps)
{
    $doc = new DOMDocument();
    $doc->loadHTML($steps, LIBXML_HTML_NODEFDTD);
    $doc = $doc->firstChild->firstChild;
    $content = "";
    for ($i = 0; $i < $doc->childNodes->length; $i++) {
        $child = $doc->childNodes[$i];
        if ($child->nodeName == "ol") {
            recursivePrintHelper($child, $content);
        } else {
            $modifiers = ["u" => false, "strong" => false];
            while ($child->firstChild != null) {
                $modifiers["u"] = $child->nodeName == "u" || $modifiers["u"];
                $modifiers["strong"] = $child->nodeName == "strong" || $modifiers["strong"];
                $child = $child->firstChild;
            }
            if($child->nodeName === "br") {
                continue;
            }
            if ($modifiers["u"]) {
                $content .=  '__';
            }
            if ($modifiers["strong"]) {
                $content .=  '#';
            }
            $content .=  $child->textContent;
            if ($modifiers["strong"]) {
                $content .=  '#';
            }
            if ($modifiers["u"]) {
                $content .=  '__';
            }
            $content .=  PHP_EOL;
        }
    }
    return $content;
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
$config->output = $config->name . "Project" . $config->project_num . " - " .  $config->project_title;
$numInputs = count($_FILES["input_files"]["tmp_name"]);
for ($i = 0; $i < $numInputs; $i++) {
    $inputFile = new stdClass;
    $inputFile->path = $_FILES["input_files"]["tmp_name"][$i];
    $inputFile->name = $_FILES["input_files"]["name"][$i];
    array_push($config->input_files, $inputFile);
}
$numOutputs = count($_FILES["output_files"]["tmp_name"]);
for ($i = 0; $i < $numOutputs; $i++) {
    $outputFile = new stdClass;
    $outputFile->path = $_FILES["output_files"]["tmp_name"][$i];
    $outputFile->name = $_FILES["output_files"]["name"][$i];
    array_push($config->output_files, $outputFile);
}
if ($_POST["algorithm_step_choice"] == "internal") {
    $config->algorithm_steps  = parseSteps($_POST["algorithm_steps_text"]);
} else {
    $config->algorithm_steps = file_get_contents($_FILES["algorithm_step_file"]["tmp_name"]);
}
$configFileName = tempnam(sys_get_temp_dir(), "conf");
$configFile = fopen($configFileName, "w");
fwrite($configFile, json_encode($config));
fclose($configFile);
$filename = shell_exec("../python/venv/bin/python3 ../python/report_generator.py " . $configFileName);
header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=" . $filename);
header('Content-Length: ' . filesize($filename));
readfile($filename);
unlink($filename);
?>