import React, {useEffect, useState} from 'react';
import useFetchApi from "../../../utils/fetchApi/useFetchApi";
import ItemResponseReservations from "./ItemResponseReservations";

/**
 * Author Jaures Kano <ruddyjaures@gmail.com>
 * Components GestionsReservations
 * Componenets desc : { }
 */
export default function GestionsReservations({idBooking}) {
    const [reservation, setReservation] = useState([])
    const [done, setDone] = useState(false)
    const [lockHour, setLockHour] = useState([])
    const {data, loading, getItem} = useFetchApi('/api/reservations')
    const {data: reponse, loading: loadindResponse, postData} = useFetchApi('/api/response/booking')

    useEffect(() => {
        getItem(idBooking)
    }, [])

    useEffect(() => {
        data.id && setReservation(data.reservationsHoraires)
    }, [data])

    useEffect(() => {
        if (reponse.isOk === true) {
            setLockHour([])
            setTimeout(() => {
                window.location.href = '/admin'
            }, 5000)
        }

        if (reponse.isOk === false && reponse?.lockHour?.length > 0) {
            setLockHour(reponse.lockHour)
        }
    }, [reponse])


    useEffect(() => {
        let count = 0;
        reservation.map((item) => {
            item.reponse !== undefined && count++
        })
        reservation.length > 0 && count === reservation.length && setDone(true)
    }, [reservation])


    const onReponse = () => {
        postData({
            id: data.id,
            reservation: reservation
        })
    }

    return (
        <div className="row w-100 ">
            {lockHour.length > 0 &&
            <div className="col-12 w-100">
                <div className="row">
                    {lockHour?.map((item, index) => {
                            let timeStart = window.formatDate(item.startAt, 'HH:mm')
                            let timeEnd = window.formatDate(item.finishAt, 'HH:mm')
                            let date = window.formatDate(item.date, 'YYYY-MM-DD')

                            return (<div key={index} className="col-12">
                                <button className="btn btn-sm border-0 shadow-sm btn-danger w-100 mt-3">
                                    {window.formatDate(date + ' ' + timeStart, 'DD MMMM YYYY HH:mm')}
                                    - {window.formatDate(date + ' ' + timeEnd, 'DD MMMM YYYY HH:mm')}
                                </button>
                            </div>)
                        }
                    )}
                </div>
            </div>}
            <div className="col-12 w-100">
                <div className="row">
                    {data.prestations?.map((item, index) =>
                        <div key={index} className="col-12 col-md-6">
                            <button className="btn border-0 shadow-sm btn-primary w-100 mt-3">
                                {item.label}
                            </button>
                        </div>
                    )}
                </div>
            </div>
            <div className="col-12 mt-4">
                <table className="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>Jours</th>
                        <th>Debut</th>
                        <th>Fin</th>
                        <th>Repondre</th>
                    </tr>
                    </thead>
                    <tbody>
                    {reservation?.map((item, index) =>
                        <ItemResponseReservations setDone={setDone} item={item} key={index}
                                                  setReservation={setReservation} reservation={reservation}
                                                  index={index}/>
                    )}
                    </tbody>
                </table>
            </div>
            <div className="col-12  mt-4">
                <button onClick={() => onReponse()} disabled={loadindResponse || done === false}
                        className="btn btn-primary w-100">
                    Repondre
                </button>
            </div>
        </div>
    );
}
