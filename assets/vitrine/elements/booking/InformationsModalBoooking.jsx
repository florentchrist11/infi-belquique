import React, {useEffect} from 'react';
import {Form, Modal} from 'react-bootstrap'
import {Controller, useForm} from "react-hook-form";

/**
 * Components name : InformationsModalBoooking
 * description:
 * param: { }
 * max 5 props
 */
export default function InformationsModalBoooking({
                                                      open, setOpen, choice, acte,
                                                      setActe, setChoice, data, loading, postData
                                                  }) {
    const {handleSubmit, reset, formState, control} = useForm({
        defaultValues: defaultValue,
        mode: "onChange"
    })

    useEffect(() => {
        if (data.isOk) {
            setActe('')
            setChoice([])
            reset(defaultValue)
            setOpen(false)
        }
    }, [data])

    const handleClose = () => setOpen(false);

    const onSubmit = (data) => {
        postData({
            choice: choice,
            acte: acte,
            data: data
        })
    }

    return (
        <Modal show={open} onHide={handleClose} animation={true} size={'lg'}>
            <Modal.Header closeButton>
                <Modal.Title>Formulaire de reseignement</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <form onSubmit={handleSubmit(onSubmit)}>
                    <div className="row p-1">
                        <div className="col-12 mt-3">
                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Controller name="nom" control={control} rules={{required: true}}
                                            render={({field}) =>
                                                <Form.Control {...field} type="text" placeholder="Nom (s) *"/>}/>
                            </Form.Group>
                        </div>
                        <div className="col-12 mt-3">
                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Controller name="prenom" control={control}
                                            render={({field}) =>
                                                <Form.Control {...field} type="text" placeholder="Prenom (s)"/>}/>
                            </Form.Group>
                        </div>
                        <div className="col-12 mt-3">
                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Controller name="email" control={control} rules={{required: true}}
                                            render={({field}) =>
                                                <Form.Control {...field} type="email" placeholder="Email *"/>}/>
                            </Form.Group>
                        </div>
                        <div className="col-12 mt-3">
                            <Form.Group className="mb-3">
                                <Controller name="contact" control={control} rules={{required: true}}
                                            render={({field}) =>
                                                <Form.Control type="text" {...field}
                                                              placeholder="Numéro de téléphone *"/>}/>
                            </Form.Group>
                        </div>
                        <div className="col-12 mt-3">
                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Controller name="localisation" control={control}
                                            render={({field}) =>
                                                <Form.Control  {...field} type="text" placeholder="Localisation"/>}/>
                            </Form.Group>
                        </div>
                        <div className="col-12 mt-3">
                            <button className="w-100 btn btn-primary mb-2"
                                    disabled={loading || !formState.isValid}>
                                {loading ? 'Envois en cours...' : 'Terminer'}
                            </button>
                        </div>
                    </div>
                </form>
            </Modal.Body>
        </Modal>
    );
}

const defaultValue = {
    nom: '',
    prenom: '',
    email: '',
    contact: '',
    localisation: ''
}