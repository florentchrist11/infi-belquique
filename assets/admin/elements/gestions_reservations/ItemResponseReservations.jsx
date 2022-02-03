import React, {useEffect, useState} from 'react';

/**
 * Author Jaures Kano <ruddyjaures@gmail.com>
 * Components ItemResponseReservations
 * Componenets desc : {}
 */
export default function ItemResponseReservations({item, setReservation, index, reservation, setDone}) {
    const [date, setDate] = useState(window.formatDate(item.date, 'YYYY-MM-DD'))
    const [res, setRes] = useState(item)

    useEffect(() => {
        let oldArray = [...reservation]
        oldArray[index] = res
        setReservation(oldArray)
    }, [res])

    const onDateChange = (value) => {
        setDate(value)
        setRes(prev => ({...prev, otherDate: value}))
    }

    const onAccept = () => setRes(prev => ({...prev, reponse: true}))

    const onRefuse = () => setRes(prev => ({...prev, reponse: false}))

    return (
        <tr>
            <td><input value={date} onChange={(e) => onDateChange(e.target.value)}
                       className="form-control form-control-sm" type="date"/></td>
            <td>{window.formatDate(item.startAt, 'HH:mm')}</td>
            <td>{window.formatDate(item.finishAt, 'HH:mm')}</td>
            <td>
                <div className="row justify-content-around">
                    <div className="col-4">
                        <button disabled={item?.reponse === false} className="btn btn-sm shadow btn-danger mr-3"
                                onClick={() => onRefuse()}>
                            <i className="fas fa-ban"></i>
                        </button>
                    </div>
                    <div className="col-4">
                        <button disabled={item?.reponse === true} className="btn btn-sm shadow btn-success"
                                onClick={() => onAccept()}>
                            <i className="fas fa-check-circle"></i>
                        </button>
                    </div>
                </div>
            </td>
        </tr>
    );
}
