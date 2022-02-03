import React from 'react';
import {Card} from "react-bootstrap";
import AutoCompletion from "./AutoCompletion";

/**
 * Author Jaures Kano <ruddyjaures@gmail.com>
 * Components FormInfo
 * Componenets desc : {
 *
 *  }
 */
export default function FormInfo({handleSubmit, onSubmit, register, isValid, loading, code, setCode, errors}) {

    return (
        <>
            <div className="card-title">Entez vos informations</div>
            <Card.Subtitle className="mb-2 text-muted">
                Entrez votre information pour pouvoir etre contactez</Card.Subtitle>
            <form onSubmit={handleSubmit(onSubmit)}>
                <div className="row p-1">
                    <div className="col-12 col-md-6 mt-3">
                        <input type="text" {...register('nom', {required: true})} placeholder="Nom(s)"
                               className={`form-control ${errors.nom?.type && 'is-invalid'}`}/>
                        {errors.nom?.type === 'required' &&
                        <div className="invalid-feedback">
                            Ce champ ne dois pas etre vide.
                        </div>}
                    </div>
                    <div className="col-12 col-md-6 mt-3">
                        <input type="text" {...register('prenom', {required: true})} placeholder="Prénom(s)"
                               className={`form-control ${errors.prenom?.type && 'is-invalid'}`}/>
                        {errors.prenom?.type === 'required' &&
                        <div className="invalid-feedback">
                            Ce champ ne dois pas etre vide.
                        </div>}
                    </div>
                    <div className="col-12 col-md-6 mt-3">
                        <input type="email" {...register('email', {required: true})} placeholder="Email"
                               className={`form-control ${errors.email?.type && 'is-invalid'}`}/>
                        {errors.email?.type === 'required' &&
                        <div className="invalid-feedback">
                            Ce champ ne dois pas etre vide.
                        </div>}
                    </div>
                    <div className="col-12 col-md-6 col-md-6 mt-3">
                        <input {...register('contact', {required: true})} placeholder="Numéro de téléphone"
                               className={`form-control ${errors.contact?.type && 'is-invalid'}`}/>
                        {errors.contact?.type === 'required' &&
                        <div className="invalid-feedback">
                            Ce champ ne dois pas etre vide.
                        </div>}
                    </div>
                    <div className="col-12 col-md-6 mt-3">
                        <AutoCompletion value={code} setValue={setCode}
                                        url={'/api/belgique_code_postauxes'} label={'Votre code postal'}/>
                    </div>
                    <div className="col-12 col-md-6 mt-3">
                        <input type="text" {...register('numeroPorte', {required: true})} placeholder="Numéro de porte"
                               className={`form-control ${errors.numeroPorte?.type && 'is-invalid'}`}/>
                        {errors.numeroPorte?.type === 'required' &&
                        <div className="invalid-feedback">
                            Ce champ ne dois pas etre vide.
                        </div>}
                    </div>
                    <div className="col-12 mt-3">
                        <input type="text" {...register('rue', {required: true})} placeholder="Nom de la rue"
                               className={`form-control ${errors.rue?.type && 'is-invalid'}`}/>
                        {errors.rue?.type === 'required' &&
                        <div className="invalid-feedback">
                            Ce champ ne dois pas etre vide.
                        </div>}
                    </div>
                    <div className="col-12 mt-3">
                        <button className="w-100 btn btn-primary mb-2"
                                disabled={loading || code.length === 0}>
                            {loading ? 'Envois en cours...' : 'Terminer'}
                        </button>
                    </div>
                </div>
            </form>
        </>
    );
}
