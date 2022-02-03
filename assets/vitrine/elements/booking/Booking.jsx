import React, {useState} from 'react';
import useFetchApi from "../../../utils/fetchApi/useFetchApi";
import BookingSystems from "./booking_systems/BookingSystems";
import PersonnalsInfo from "./personnals_infos/PersonnalsInfo";

/**
 * Components name : Booking
 * description:
 * param: { }
 * max 5 props
 */
export default function Booking({idCategorie}) {
    const {data, loading, postData, clearData} = useFetchApi('/booking/save/')
    const [choice, setChoice] = useState([])
    const [actes, setActes] = useState([])
    const [open, setOpen] = useState(false)


    return (
        <div className="w-100 mb-4">
            {open === true ?
                <PersonnalsInfo choice={choice} acte={actes} data={data} setOpen={setOpen}
                                setActe={setActes} loading={loading} open={open} clearData={clearData}
                                postData={postData} setChoice={setChoice}/>
                :
                <BookingSystems setActes={setActes} setOpen={setOpen} data={data} idCategorie={idCategorie}
                                setChoice={setChoice} actes={actes} choice={choice}/>
            }
        </div>
    );
}