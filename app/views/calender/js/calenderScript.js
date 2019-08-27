
/*var mon = parseInt("<?php echo $month; ?>");*/
var mon = +document.getElementById('month').getAttribute('num');
console.log(mon);
/*var year = parseInt('<?php echo $year; ?>');*/
var year = +document.getElementById('year').innerHTML;
console.log(year);

function monthf(pn){
    console.log(pn);

    if (pn == 'next'){
        mon++;
    }else if (pn == 'prev'){
        mon--;
    }else{
        alert('Неправильный параметр');
        return false;
    }
    if (mon > 12){
        year ++;
        mon = 1;
    }
    if (mon < 1){
        year --;
        mon = 12;
    }
    if ((mon < 10) && (mon >= 1)){
        mon = '0'+mon;
    }
    var nextDate = year+'-'+mon+'-00';

    var ajaxaddr = 'calender?date='+nextDate;
    var http = new XMLHttpRequest();
    if (http) {
        http.open('get', ajaxaddr);
        http.onreadystatechange = function () {
            if(http.readyState == 4){
                if (http.status == 200) {
                    document.getElementById('calendar').innerHTML = http.responseText;
                };
            };
        }
        http.send(null);
    };
};