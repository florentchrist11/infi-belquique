import React, {useEffect, useState} from 'react';
import _ from "lodash";

/**
 * Components name : TimeCroiser
 * description:
 * param: { }
 * max 5 props
 */
export default function TimeCroiser({row, days, weekDays, loading, setChoice, choice}) {

    const onSelectCernaux = (value, item) => {
        let array = [...choice]
        array = [...array, `${item} ${value}`]
        setChoice(array)
    }

    return _.times(row, (i) => (
        <tr align="center" key={i}>
            {weekDays.map((item, index) =>
                <ShowCrennaux key={index} days={days} choice={choice}
                              loading={loading} i={i} item={item} weekDays={weekDays}
                              onSelectCernaux={onSelectCernaux}/>)}
        </tr>
    ))
}


function ShowCrennaux({days, item, choice, i, loading, onSelectCernaux, weekDays}) {
    const [state, setState] = useState(false)
    let value = null
    if (days[item]) {
        if (days[item][i]) {
            value = days[item][i]
        }
    }


    useEffect(() => {
        setState(choice.includes(`${item} ${value}`))
    }, [days, weekDays, choice])

    return (
        <td>
            {loading ?
                '...'
                :
                value !== null ?
                    <button onClick={() => {
                        setState(true)
                        onSelectCernaux(value, item)
                    }} disabled={state}
                            className={`btn shadow-sm ${state ? 'btn-secondary' : 'btn-outline-secondary'}`}>
                        {value}
                    </button> : '--'}
        </td>)
}