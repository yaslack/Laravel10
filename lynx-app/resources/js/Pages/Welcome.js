import moment from 'moment';

moment.locale('fr');
var m = moment(1316116057189);
m.fromNow(); // il y a une heure

export const loger = log();
function log(){
    console.log(m);
}