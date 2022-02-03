function NotificationsReponse(error, setData) {
    // let response = error.response.data
    if (error.status > 199 && error.status < 300) {
        let reponseData = error.data
        reponseData.message && window.notification('success', 'Opération reussi', reponseData.message)
    }

    if (error.response?.status) {
        let status = error.response.status
        let responseData = error.response.data
        if (status >= 400 && status < 500) {
            setData(responseData)
            responseData.message && window.notification('error', 'Echec de l\'opération', responseData.message)
        }
        if (error.response.status === 500) {
            window.notification('error', 'Erreur de connexion', 'Probleme avec la connexion au serveur')
        }
    }

}

export default NotificationsReponse;