import moment from "moment";

window.formatDate = (dateSend, format = 'DD MMMM YYYY') => {
    return moment(dateSend).format(format)
}