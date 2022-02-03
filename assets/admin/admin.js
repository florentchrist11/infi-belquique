/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
window.bootstrap = require('bootstrap/dist/js/bootstrap.bundle.js');
// libs js for admin dashboard
import 'jquery'
import 'bootstrap/dist/js/bootstrap.bundle'
import 'jquery-slimscroll/jquery.slimscroll.min'
import './js/main'
import './js/sidebarMenu'
import './elements/gestions_reservations/_gestionReservation'
// any CSS you import will output into a single css file (app.css in this case)
import './admin.scss';

import 'datatables.net/js/jquery.dataTables.min'
import 'datatables.net-responsive/js/dataTables.responsive.min'
import 'datatables.net-bs5/js/dataTables.bootstrap5.min'
import 'datatables.net-responsive-bs5/js/responsive.bootstrap5.min'

let iziToast = require('izitoast')

window.notification = (type, title, message) => {
    iziToast[type]({
        title: title,
        message: message,
        position: 'topRight',
        timeout: 10000,
    });
}


let french = {
    "sEmptyTable": "Aucune donnée disponible dans le tableau",
    "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
    "sInfoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
    "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
    "sInfoPostFix": "",
    "sInfoThousands": ",",
    "sLengthMenu": "Afficher _MENU_ éléments",
    "sLoadingRecords": "Chargement...",
    "sProcessing": "Traitement...",
    "sSearch": "Rechercher :",
    "sZeroRecords": "Aucun élément correspondant trouvé",
    "oPaginate": {
        "sFirst": "Premier",
        "sLast": "Dernier",
        "sNext": "Suivant",
        "sPrevious": "Précédent"
    },
    "oAria": {
        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
    },
    "select": {
        "rows": {
            "_": "%d lignes sélectionnées",
            "0": "Aucune ligne sélectionnée",
            "1": "1 ligne sélectionnée"
        }
    }
}


$('#datatable').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "language": french,
    "pageLength": 20
});