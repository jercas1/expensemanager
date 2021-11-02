import Vue from "vue"

Vue.filter("date", string => {
    const datetime = new Date(string) 

    const year = datetime.getFullYear();
    let month = datetime.getMonth() + 1;
    if (month < 10) {
        month = '0' + month;
    }
    let date = datetime.getDate();
    if (date < 10) {
        date = '0' + date;
    }

    let hour = datetime.getHours();
    let period = 'AM';
    if (hour > 12) {
        hour -= 12;
        period = 'PM';
    }
    if (hour < 10) {
        hour = '0' + hour;
    }
    let minutes = datetime.getMinutes();
    if (minutes < 10) {
        minutes = '0' + minutes;
    }
    let seconds = datetime.getSeconds();
    if (seconds < 10) {
        seconds = '0' + seconds;
    }

    return `${year}-${month}-${date}`;
});

