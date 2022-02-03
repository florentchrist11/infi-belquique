import React from 'react';
import {AsyncTypeahead, Highlighter} from 'react-bootstrap-typeahead'
import useFetchApi from "../../../../utils/fetchApi/useFetchApi";

/**
 * Components AutoCompletion
 * @Author Jaures Kano <ruddyjaures@gmail.com>
 */
export default function AutoCompletion({value, setValue, url, label}) {
    const {data, loading, searchData} = useFetchApi(url)

    const handleSearch = (query) => {
        searchData(`?code=${query}`)
    }

    return (
        <div className="input-group">
            <AsyncTypeahead
                id="async-example"
                className={`${value.length === 0 && 'is-invalid'}`}
                isLoading={loading}
                onChange={setValue}
                selected={value}
                labelKey="code"
                renderMenuItemChildren={(option, {text}, index) => (
                    <Highlighter search={text} highlightClassName={'r'}>
                        {`${option.code} - ${option.localite}`}
                    </Highlighter>
                )}
                minLength={2}
                onSearch={handleSearch}
                options={data}
                placeholder={label}
            />
            {value.length === 0 &&
            <div className="invalid-feedback">
                Ce champ est vide, entrez les premiers chiffre de votre code postal puis selectionner le.
            </div>}
        </div>
    );
}