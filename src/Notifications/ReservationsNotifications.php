<?php

namespace App\Notifications;


use App\Entity\Reservations\Reservations;
use App\Repository\Reservations\ReservationsHorairesRepository;
use DateInterval;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

/**
 * Class ReservationsNotifications
 * @author jaures kano <ruddyjaures@gmail.com>
 * @package App\Notifications
 */
class ReservationsNotifications extends AbstractController
{
    private MailerInterface $mailer;

    private ReservationsHorairesRepository  $reservationRepo;


    /**
     * ReservationsNotifications constructor.
     * @param MailerInterface $mailer
     * @param ReservationsHorairesRepository $reservationRepo
     */
    public function __construct(MailerInterface $mailer,
                                ReservationsHorairesRepository $reservationRepo)
    {
        $this->mailer = $mailer;
        $this->reservationRepo = $reservationRepo;
    }

    public function sendMail(Reservations $reservation): void
    {
        $message = (new TemplatedEmail())
            ->from('stephhealthplace@gmail.com')
            ->to($reservation->getPatientsEnregistrer()->getEmail())
            ->subject('Confirmation de votre reservation chez stephHealplace')
            ->text('Email de confirmation de votre reservation sur la plateforme stephHealplace.')
            ->htmlTemplate('emails/reservation_confirmation_email.html.twig')
            ->context([
                'reservation' => $reservation,
                'patient' => $reservation->getPatientsEnregistrer(),
                'horaires' => $this->reservationRepo->findBy(['reservation' => $reservation->getId()]),
                'expiredAt' => $reservation->getCreatedAt()->add(new DateInterval('PT6H'))
            ]);
        $this->mailer->send($message);
    }

}