import React, {useEffect, useState} from 'react';
import {Table} from "react-bootstrap";
import moment from 'moment';
import useFetchApi from "../../../../utils/fetchApi/useFetchApi";
import TimeCroiser from "./TimeCroiser";
import TitleBooking, {getThisWeekDates} from "./TitleBooking";

/**
 * Components name : SelectTime
 * description:
 * param: { }
 * max 5 props
 */
export default function SelectTime({choice, setChoice}) {
    const {data, loading, postData} = useFetchApi('/api/build/request/date')
    const [search, setSearch] = useState(0)
    const [currentWeek, setCurrentWeek] = useState(parseInt(moment().format('W')) + 1)
    const [week, setWeek] = useState(parseInt(moment().format('W')) + 1)
    const [weekdayNames, setWeekdayNames] = useState(getThisWeekDates(week))

    useEffect(() => {
        weekdayNames.length > 0 && postData({days: weekdayNames})
    }, [weekdayNames])

    return (
        <Table>
            <TitleBooking setSearch={setSearch} currentWeek={currentWeek} setWeek={setWeek}
                          setWeekdayNames={setWeekdayNames} week={week} weekdayNames={weekdayNames}/>
            <thead>
            <tr align="center">
                {weekdayNames.map((item, index) => <th key={index}>{window.formatDate(item, 'DD/MM/YY')}</th>)}
            </tr>
            </thead>
            <tbody>
            <TimeCroiser loading={loading} days={data.dispo ? data.dispo : {}} setChoice={setChoice}
                         row={data.row ? data.row : 3} weekDays={weekdayNames} choice={choice}/>
            </tbody>
        </Table>
    );
}

