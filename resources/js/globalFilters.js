// dayjs
import dayjs from 'dayjs'
import 'dayjs/locale/ru'
import utc from 'dayjs/plugin/utc'
dayjs.extend(utc)

export default {
    date(date) {
        return dayjs(date).locale('ru').utcOffset(5).format('DD.MM.YYYY')
    },
    dateWithTime(date) {
        return dayjs(date).locale('ru').utcOffset(5).format('DD.MM.YYYY H:mm')
    },
    currentDate() {
        return dayjs(new Date()).locale('ru').format('YYYY-MM-DD')
    },
    currencyRub(value) {
        if (!value) return '0₽'
        return parseInt(value).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + '₽'
    },
    currencyUsd(value) {
        if (!value) return '$0'
        return '$' + parseInt(value).toFixed(0).toString()
    },
}
