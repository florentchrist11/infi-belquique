import React, {useEffect, useState} from 'react';
import {useForm} from "react-hook-form";
import FormInfo from "./FormInfo";

/**
 * Author Jaures Kano <ruddyjaures@gmail.com>
 * Components PersonnalsInfo
 * Componenets desc : {
 *   
 *  }
 */
export default function PersonnalsInfo({
                                           open, setOpen, choice, acte, clearData,
                                           setActe, setChoice, data, loading, postData
                                       }) {
    const [send, setSend] = useState(false)
    const [code, setCode] = useState([])
    const {handleSubmit, reset, register, formState: {errors, isValid}} = useForm({
        defaultValues: defaultValue,
        mode: "onChange"
    })

    useEffect(() => {
        data.isOk === true && setSend(true)
    }, [data])

    const onSubmit = (data) => {
        postData({
            choice: choice,
            acte: acte,
            data: data,
            code: code[0].id
        })
    }

    const onRestart = () => {
        setActe('')
        setChoice([])
        reset(defaultValue)
        setOpen(false)
        clearData()
    }

    return (
        <div className="card p-1 p-md-3">
            <div className="card-body">
                {send === true ?
                    <div className="row mt-4">
                        <div className="col-12">
                            <div className="m-auto" style={{height: '300px'}}>
                                <img className="w-100 h-100" src="/images/mail/mail.svg" alt="...."/>
                            </div>
                        </div>
                        <div className="col-12 text-center mt-4">
                            <span>Un mail de confirmation à été envoyé pour confirmer votre reservation,
                                <a href="#" onClick={() => onRestart()}> Reservez à nouveau</a></span>
                        </div>
                    </div>
                    :
                    <FormInfo loading={loading} code={code} setCode={setCode} register={register} isValid={isValid}
                              handleSubmit={handleSubmit} onSubmit={onSubmit} errors={errors}/>
                }
            </div>
        </div>
    );
}

const defaultValue = {
    nom: '',
    prenom: '',
    email: '',
    contact: '',
    numeroPorte: '',
    rue: ''
}