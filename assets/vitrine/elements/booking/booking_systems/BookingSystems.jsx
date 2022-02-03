import React from 'react';
import {Alert, Card} from "react-bootstrap";
import ListsConsultations from "../ListsConsultations";
import SelectedCrennaux from "../times/SelectedCrennaux";
import SelectTime from "../times/SelectTime";

/**
 * Author Jaures Kano <ruddyjaures@gmail.com>
 * Components BookingSystems
 * Componenets desc : {
 *
 *  }
 */
export default function BookingSystems({setActes, actes, setChoice, choice, setOpen, data, idCategorie}) {

    return (
        <div className="card p-1 p-md-3">
            <div className="card-body">
                <div className="card-title">Formulaire de reservation</div>
                <Card.Subtitle className="mb-2 text-muted">
                    Choisissez l'acte choisis et les crenaux horaires que vous souhaitez</Card.Subtitle>
                <div className="row">
                    <div className="col-12 mt-3 w-100 mx-auto">
                        <ListsConsultations setActes={setActes} idCategorie={idCategorie} actes={actes}/>
                    </div>
                    {data.message &&
                    <div className="col-12 mt-3">
                        <Alert variant="info" dismissible>
                            <Alert.Heading>{data.message?.title}</Alert.Heading>
                            <p>{data.message?.desc}</p>
                        </Alert>
                    </div>}
                    <div className="col-12 mt-3">
                        <SelectedCrennaux choice={choice} setChoice={setChoice}/>
                    </div>
                    <div className="col-12 mt-3">
                        <SelectTime choice={choice} setChoice={setChoice}/>
                    </div>
                    <div className="col-12 col-md-4 ms-auto  mt-3">
                        <button className="w-100 btn btn-primary" onClick={() => setOpen(true)}
                                disabled={actes.length === 0 || choice.length === 0}>
                            Reserver
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );
}
