import React, {useEffect} from 'react';
import moment from "moment";

/**
 * Components name : TitleBooking
 * description:
 * param: { }
 * max 5 props
 */
export default function TitleBooking({week, setWeek, currentWeek, setSearch, setWeekdayNames, weekdayNames}) {
    useEffect(() => {
        setWeekdayNames(getThisWeekDates(week))
        setSearch(p => p + 1)
    }, [week])

    const onWeekChange = (num) => {
        setWeek(p => p + num)
    }

    return (
        <thead>
        <tr align="center">
            <th align="center">
                <button className="btn shadow-sm btn-primary"
                        onClick={() => onWeekChange(-1)} disabled={week <= currentWeek}>
                    <i className="fas fa-arrow-left"></i>
                </button>
            </th>
            <th colSpan="5" align="center">Semaine du {weekdayNames[0] ? window.formatDate(weekdayNames[0]) : '--'}
                au {weekdayNames[0] ? window.formatDate(weekdayNames[6]) : '--'} </th>
            <th align="center">
                <button className="btn shadow-sm btn-primary"
                        disabled={week >= 52} onClick={() => onWeekChange(1)}>
                    <i className="fas fa-arrow-right"></i>
                </button>
            </th>
        </tr>
        </thead>
    );
}

export function getThisWeekDates(currentWeek) {
    let weekDates = [];
    let monday = moment(currentWeek, 'w').format('YYYY-MM-DD')

    for (let i = 0; i < 7; i++) {
        let weekDate = moment(monday).add(i, 'days')
        weekDates.push(weekDate.format('YYYY-MM-DD'));
    }

    return weekDates;
}