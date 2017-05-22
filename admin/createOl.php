<!DOCTYPE html>
<html>
<head>
    <title>Создание Олимпиады</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="js/olympiadCreation.js"></script>

    <link rel="stylesheet" href="css/OlympiadCreation.css">
</head>
<body>
<div class="Header">
    <h1>MCMS Admin Access</h1>
</div>
<div>
    <form id="olympiadForm">
        <label>Введите название олимпиады:</label>
        <input type="text" id="OlympName" required width="300"><br>

        <label>Введите класс:</label>
        <input type="number" id="OlympGrade" min="1" max="11" maxlength="2" required width="300"><br>

        <label>Введите периодичность обновления(в часах):</label>
        <input type="number" id="OlympFreq" min="1" max="24" maxlength="2" required width="300"><br>

        <label>Введите SQL запрос для обновления:</label>
        <input type="text" id="OlympSQL" required width="300"><br>

        <label>Введите дату начала: </label>
        <input type="date" id="OlympStartDate" required><br>

        <label>Введите время начала:</label>
        <input type="time" id="OlympStartTime" required><br>

        <label>Введите дату конца олимпиады:</label>
        <input type="date" id="OlympEndDate" required><br>

        <label>Введите время конца олимпиады:</label>
        <input type="time" id="OlympEndTime" required><br>
        <hr>
        <button type="button" onclick="addQuestion()">Добавить задание</button>

        <div id="questionList">

        </div>
        <button type="submit" onclick="saveOlympiad()">Сохранить</button>
    </form>
    <div id="questionBlueprint" style="display:none;">
        <h4 name="questionHeader">Задание</h4>
        <label>Вставьте порядковый номер задания:</label>
        <input type="number" name="questionSerNumber" maxlength="2" required width="300"><br>
        <label>Укажите тип задания</label>
        <select name="type">
            <option value="0">Обычное задание</option>
            <option value="1">Задание открытого типа</option>
        </select><br>
        <label>Вставьте Tex код:</label><br>
        <textarea required name="TexCode" style="width: 300px;height:200px;resize: none"></textarea><br>

        <label>Количество вариантов:</label>
        <input name="variantsNumber" type="number" maxlength="2" min="1" max="15"><br>

        <label>Количество переменных в задании</label>
        <input name="variablesNumber" type="number" maxlength="2" min="1" max="15"><br>

        <button type="button" name="initializeTable"
                onclick="initializeVariantsTable(this.parentNode.id,this.parentNode.children['variantsNumber'].value,this.parentNode.children['variablesNumber'].value)">
            Заполнить варианты
        </button>
        <div name="variantsTable" style="display: block;">
        </div>

        <button type="button" onclick="removeCurrentQuestion(this.parentNode.id)">Удалить задание</button>
        <hr>
    </div>
</div>
</body>
</html>