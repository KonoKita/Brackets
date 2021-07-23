/*==============================[Variables]==============================*/
const btn = document.querySelector('.validation__button');//кнопка

var xhr = new XMLHttpRequest();
xhr.withCredentials = true;

/*==============================[Exception handling]==============================*/
/*==============================[Processing variables]==============================*/
/*==============================[Logic]==============================*/
function doPostRequest(str,cb){
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4) {
            cb(this.responseText);
        }
    });
    xhr.open("POST", "../ajax.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(str);
}
function outputHtml(arTableData){


    let html = '<table>';
    // html += '<tr>';
    // html += '<td>' + 'Выражение' + '</td>';
    // html += '<td>' + 'Результат' + '</td>';
    // html += '</tr>';
    for (let i = 0; i < arTableData.length; i++) {
        html += '<tr>';

        html += '<td>' + arTableData[i]['expression'] + '</td>';
        html += '<td>' + arTableData[i]['result'] + '</td>';
        html += '</tr>';
    }

    html += '<table>';
    document.getElementById('validation__table').innerHTML = html;
}

btn.addEventListener('click',e => {
    input = document.querySelector('.validation__input').value.trim();
    if (input == ''){
        alert('Введите выражение')
    }
    else{
        let str ='expression=' + input;
        doPostRequest(str,response =>{
            outputHtml(JSON.parse(response));
        });
    }

});
