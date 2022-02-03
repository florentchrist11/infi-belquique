import React from "react";
import {render, unmountComponentAtNode} from "react-dom";
import GestionsReservations from "./GestionsReservations";

class _gestionReservation extends HTMLElement {

    connectedCallback() {
        let idBooking = this.getAttribute('idBooking')
        render(<GestionsReservations idBooking={idBooking}/>, this)
    }


    disconnectedCallback() {
        unmountComponentAtNode(this)
    }
}

customElements.define('gestions-reservations', _gestionReservation)