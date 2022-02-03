import {useCallback, useState} from 'react';
import AllElements from "./fetch_api_components/AllElements";
import ItemElements from "./fetch_api_components/ItemElements";
import PostData from "./fetch_api_components/PostData";
import PatchData from "./fetch_api_components/PatchData";
import ValidateData from "./fetch_api_components/ValidateData";
import SearchData from "./fetch_api_components/SearchData";
import Paginate from "./fetch_api_components/Paginate";

function useFetchApi(url) {
    const [data, setData] = useState([])
    const [loading, setLoading] = useState(false)
    const [cancel, setCancel] = useState('')
    const [query, setQuery] = useState('')
    const [page, setPage] = useState(1)
    const [totalItems, setTotalItems] = useState(0)
    const [error, setError] = useState([])

    const clearData = useCallback(async () => {
        setData([])
    }, [url])


    const getAll = useCallback(async () => {
        AllElements(url, setData, setTotalItems, setLoading)
    }, [url])

    const getItem = useCallback(async (id) => {
        ItemElements(id, url, setData, setTotalItems, setLoading)
    }, [url])

    const postData = useCallback(async (sendData) => {
        PostData(sendData, url, data, setData, setTotalItems, setLoading)
    }, [url])

    const patchData = useCallback(async (id, sendData) => {
        PatchData(id, sendData, url, data, setData, setTotalItems, setLoading)
    }, [url])

    const validateData = useCallback(async (sendData) => {
        ValidateData(sendData, url, data, setData, setTotalItems, setLoading)
    }, [url])

    const searchData = useCallback(async (q = null) => {
        SearchData(q, url, data, setData, setTotalItems, setLoading, setQuery)
    }, [url])

    const paginateTo = useCallback(async (number = 1) => {
        Paginate(number, query, cancel, setData, setTotalItems, setLoading)
    }, [url])

    return {
        data,
        setData,
        loading,
        getAll,
        postData,
        searchData,
        paginateTo,
        totalItems,
        validateData,
        error,
        getItem,
        patchData,
        clearData
    }
}

export default useFetchApi;
