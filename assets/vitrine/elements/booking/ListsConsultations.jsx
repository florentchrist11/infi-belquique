import React, {useEffect, useState} from 'react';
import {Form} from "react-bootstrap";
import useFetchApi from "../../../utils/fetchApi/useFetchApi";
import Select from 'react-select';

/**
 * Components name : ListsConsultations
 * description:
 * param: { }
 * max 5 props
 */
export default function ListsConsultations({actes, setActes, idCategorie}) {
    const {data, searchData} = useFetchApi('/api/actes_categories')
    const [categorie, setCategorie] = useState(idCategorie)
    const [prestation, setPrestation] = useState([])

    useEffect(() => {
        searchData('?')
    }, []);

    useEffect(() => {
        if (data.length > 0) {
            let selected = data.filter((obj) => {
                return obj.id === parseInt(categorie)
            })
            let newArray = []
            selected[0]?.actesPrestations.map((item) => newArray.push({value: item.id, label: item.designation}))
            window.history.pushState({}, '', '/booking/' + selected[0]?.id + '/' + selected[0]?.slug)
            setPrestation(newArray)
        }
    }, [categorie, data])

    const onSelectedChange = (inputValue) => {
        setActes(inputValue)
    }

    return (
        <div className="ol-12 w-100">
            <Form.Group controlId="formGridState" className="w-100">
                <Form.Label>Categories des prestations</Form.Label>
                <Form.Select value={categorie} onChange={(e) => setCategorie(e.target.value)}>
                    <option>Choisir dans la liste deroulante</option>
                    {data.map((item, index) => <option key={index} value={item.id}>{item.designation}</option>)}
                </Form.Select>
            </Form.Group>
            <Select
                isMulti
                defaultOptions={actes}
                onChange={onSelectedChange}
                placeholder="Choisissez une ou plusieurs prestations..."
                closeMenuOnSelect={false}
                isDisabled={prestation.length === 0}
                className="basic-multi-select mt-3"
                classNamePrefix="select"
                options={prestation}
            />
        </div>
    );
}