import React from 'react';
import moment from "moment";

/**
 * Components name : SelectedCrennaux
 * description:
 * param: { }
 * max 5 props
 */
export default function SelectedCrennaux({choice, setChoice}) {

    const removeChoice = (index) => {
        let array = [...choice]
        if (index !== -1) {
            array.splice(index, 1);
            setChoice(array)
        }
    }

    return (
        <div className="w-100">
            <div className="row justify-content-center">
                {choice.map((item, index) =>
                    <div key={index} className="col-12 col-md-4 p-2 text-center">
                    <span
                        className="btn w-100 btn-primary shadow-sm">{moment(item.substr(0, 16)).format('dddd DD MMMM YYYYY')}
                        <a onClick={() => removeChoice(index)}
                           className="btn btn-sm text-white float-end rounded-circle">
                            <i className="fas fa-ban"></i>
                        </a>
                     </span>
                    </div>)}
            </div>
        </div>
    );
}