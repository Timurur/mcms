var questionCounter = 0;
function addQuestion() {
    questionCounter++;
    //   document.getElementById("deleteQuestion").style = "display:block";
    var div = document.createElement('div');
    div.innerHTML = document.getElementById("questionBlueprint").innerHTML;

    div.name = "question" + questionCounter;

    div.id = "question" + questionCounter;
    var pointer = document.getElementById("questionList");
    pointer.append(div);
    div.children['questionHeader'].innerHTML = "Задание № " + questionCounter;
}
function delQuestion() {
    var pointer = document.getElementById("questionList");
    pointer.removeChild(pointer.lastChild);
    questionCounter--;
    if (questionCounter == 0) {
        document.getElementById("deleteQuestion").style = "display:none";
    }
}

function removeCurrentQuestion(id) {
    var element = document.getElementById(id);
    element.remove();
    questionCounter--;
    var elChildren = $("#questionList").children();
    for (var i = 0; i < elChildren.length; i++) {
        elChildren[i].id = "question" + (i + 1);
        elChildren[i].children['questionHeader'].innerHTML = "Задание №" + (i + 1);
    }
}


function initializeVariantsTable(id, variantsNumber, variablesNumber) {
    if (variantsNumber == "" || variablesNumber == "") {
        alert("Введите количество переменных и варантов!");
        return;
    }
    var pointer = document.getElementById(id).children["variantsTable"];
    pointer.innerHTML = "";
    var table = document.createElement("table");
    var thead = document.createElement("thead");
    thead.setAttribute("name", "tableHead")
    var tbody = document.createElement("tbody");
    var questionType = document.getElementById(id).children['type'].value;
    tbody.setAttribute("name", "tableBody")
    table.append(thead);
    table.append(tbody);
    table.setAttribute("name", "varTable");

    var headerRow = document.createElement("tr");
    headerRow.setAttribute("name", "headerRow");
    var cornerHeader = document.createElement('th');
    cornerHeader.innerHTML = "Вариант/Переменные";
    cornerHeader.style.maxWidth = "80px";
    headerRow.append(cornerHeader);
    for (var i = 1; i <= variablesNumber; i++) {
        var variableCell = document.createElement("th");
        var variableName = document.createElement("input");
        variableName.setAttribute("name", "variableName");
        variableName.setAttribute("pattern", "[A-Za-z]{3}");
        variableName.setAttribute("style", "width:50px;");

        variableCell.append(variableName);
        headerRow.append(variableCell);
    }
    if (questionType == "0") {
        var ansHeader = document.createElement("th");
        ansHeader.innerHTML = "Ответ";
        headerRow.append(ansHeader);
    }
    thead.append(headerRow);

    for (var j = 1; j <= variantsNumber; j++) {

        var variantRow = document.createElement('tr');
        var variantHeader = document.createElement('th');
        variantHeader.innerHTML = j;
        variantRow.append(variantHeader);
        for (var k = 0; k < variablesNumber; k++) {
            var variantVariableCell = document.createElement("td");
            var variantVariableValue = document.createElement('input');
            variantVariableValue.setAttribute("name", "variableValue");
            variantVariableValue.setAttribute("pattern", "[0-9]{3}");
            variantVariableValue.setAttribute("style", "width:50;");
            variantVariableCell.append(variantVariableValue);
            variantRow.append(variantVariableCell);
        }
        if (questionType == "0") {//
            var variantAnswer = document.createElement('td');
            var variantAnswerValue = document.createElement('input');
            variantAnswerValue.setAttribute("name", "answer")
            variantAnswer.appendChild(variantAnswerValue);
            variantRow.append(variantAnswer);
        }
        tbody.append(variantRow);
    }
    pointer.append(table);
}

function saveOlympiad() {
    var OlympId = "";
    var OlympName = document.getElementById("OlympName").value;
    var OlympGrade = document.getElementById("OlympGrade").value;
    var OlympFreq = document.getElementById("OlympFreq").value;
    var OlympSQL = document.getElementById("OlympSQL").value;
    var OlympStartDate = document.getElementById("OlympStartDate").value;
    var OlympStartTime = document.getElementById("OlympStartTime").value;
    var OlympEndDate = document.getElementById("OlympEndDate").value;
    var OlympEndTime = document.getElementById("OlympEndTime").value;
    var questionNumber = document.getElementById("questionList").children.length;
    var questionList = document.getElementById("questionList").children;
    var questionArray = [];
    for (var i = 0; i < questionNumber; i++) {
        var question = questionList[i];
        var questionSerNumber = question.children['questionSerNumber'].value;
        var questionType = question.children['type'].value;
        var questionCode = question.children['TexCode'].value;

        var variantsTable = question.children['variantsTable'].children['varTable'];
        var tableHead = variantsTable.children['tableHead'].children['headerRow'];
        var variablesArr = [];
        for (var j = 1; j < tableHead.children.length - 1; j++) {
            variablesArr[j - 1] = tableHead.children[j].children['variableName'].value;
        }
        var tableBody = variantsTable.children['tableBody'].children;
        var variantsArr = [];

        for (var k = 0; k < tableBody.length; k++) {
            var curRow = tableBody[k];
            var variantObject = {};
            variantObject["variantNumber"] = curRow.children[0].innerHTML;
            for (var m = 1; m < curRow.children.length - 1; m++) {
                var key = variablesArr[m - 1];
                variantObject[key] = curRow.children[m].children['variableValue'].value;
            }
            if (questionType == "0") {

                var variantAnswer = curRow.lastChild.children['answer'].value;
                variantObject['answer'] = variantAnswer;
            }
            variantsArr.push(JSON.stringify(variantObject));
        }
        var questionObject = {
            "olymp_id": OlympId,
            "task_id": questionSerNumber,
            "isOpenAnswer": questionType,
            //"task_type": questionType,
            "TEX_code": questionCode,
            "task_variables": variablesArr,
            "variants": variantsArr
        };
        //!
        questionArray.push(JSON.stringify(questionObject));
    }
    var olympiadObject = {
        "id": OlympId,
        "name": OlympName,
        "grade": OlympGrade,
        "refresh_time": OlympFreq,
        "refresh_SQL_request": OlympSQL,
        "start_time": OlympStartDate + " " + OlympStartTime,
        //"start_date": OlympStartDate,
        "finish_time": OlympEndDate + " " + OlympEndTime,
        //"finish_date": OlympEndDate,
        "tasks": questionArray
    };

    return olympiadObject;

}

function fillTheTable(jsonString) {
    var object = JSON.parse(jsonString);
    var startTime = object['start_time'].split(" ")[1];
    var startDate = object['start_time'].split(" ")[0];
    var endTime = object['finish_time'].split(" ")[1];
    var endDate = object['finish_time'].split(" ")[0];
    $("#OlympName").val(object['name']);
    $("#OlympGrade").val(object['grade']);
    $("#OlympFreq").val(object['refresh_time']);
    $("#OlympSQL").val(object['refresh_SQL_request']);
    $("#OlympStartDate").val(startDate);
    $("#OlympStartTime").val(startTime);
    $("#OlympEndDate").val(endDate);
    $("#OlympEndTime").val(endTime);
    var questionsArray = object['tasks'];

    for (var i = 0; i < questionsArray.length; i++) {
        var curTask = JSON.parse(questionsArray[i]);
        addQuestion();
        $("#question" + (i + 1) + " input[name='questionSerNumber']").val(curTask.task_id);
        $("#question" + (i + 1) + " select[name='type']").val(curTask.isOpenAnswer);
        $("#question" + (i + 1) + " textarea[name='TexCode']").val(curTask.TEX_code);
        var variablesArray = curTask.task_variables;
        var variantsJSON = curTask.variants;
        var variants = [];
        for (var j = 0; j < variantsJSON.length; j++) {
            variants.push(JSON.parse(variantsJSON[j]));
        }

        $("#question" + (i + 1) + " input[name='variantsNumber']").val(variants.length);
        $("#question" + (i + 1) + " input[name='variablesNumber']").val(variablesArray.length);
        $("#question" + (i + 1) + " button[name='initializeTable']").click();

        var theadRow = $("#question" + (i + 1) + " div[name='variantsTable'] table[name='varTable'] thead").children()[0].children;
        for (var k = 1; k <= variablesArray.length; k++) {
            theadRow[k].children['variableName'].value = variablesArray[k - 1];
        }

        var tbody = $("#question" + (i + 1) + " div[name='variantsTable'] table[name='varTable'] tbody").children();

        for (var l = 0; l < variants.length; l++) {
            var curRow = tbody[l];
            var curVar = variants[l];
            for (var d = 1; d <= variablesArray.length; d++) {
                curRow.children[d].children['variableValue'].value = curVar[variablesArray[d - 1]];
            }
            if (curTask.task_type == "0") {

                curRow.children[curRow.children.length - 1].children["answer"].value = curVar.answer;
            }
        }
    }
}


$('#olympiadForm').submit(function (e) {
    e.preventDefault();
    var a = JSON.stringify(saveOlympiad());
    $.ajax({
        url: '/core/admin/addOlympiad.php',
        type: 'POST',
        data: 'olympData=' + a,
        success: function (res) {

        }
    });


});