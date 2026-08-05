"use client";
import styles from './contact.module.css';

import { useState, type FormEvent } from "react";

export default function Contact() {
  const [name, setName] = useState("");
  const [message, setMessage] = useState("");
  const [isOpen, setIsOpen] = useState(false);

  const handleSubmit = (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();

    const emailClara = "marchal.clara95@gmail.com";
    const sujet = `Message from Portfolio Contact Form - ${name}`;

    const corpsMessage =
      `Bonjour Clara\n\n` +
      `${message}\n\n` +
      `Cordialement,\n` +
      `${name}`;

    window.location.href = `mailto:${emailClara}?subject=${encodeURIComponent(sujet)}&body=${encodeURIComponent(corpsMessage)}`;
  };

  const toggleMailForm = () => {
    setIsOpen((prev) => !prev);
  };

  return (
    <>
      <button
        className={styles.mailButton} 
        onClick={toggleMailForm}
        aria-expanded={isOpen}
        aria-controls="contactContainer"
      >
        <img id="mail" className={styles.mail} src="/asset/mail.png" alt="button mail" />
      </button>

      {isOpen && (
        <div className={styles.container} id="contactContainer">
          <h3 className={styles.titre}>POST CARD</h3>
          <p>To : marchal.clara95@gmail.com</p>
          <p>Date : {new Date().toLocaleDateString()}</p>
          <img className={styles.timbre} src="/asset/timbre.png" alt="timbre" />
          <form onSubmit={handleSubmit} className="flex flex-col gap-4">
            <label className={styles.label} htmlFor="name">From :</label>
            <input
              id="name"
              type="text"
              name="name"
              placeholder="Votre nom"
              value={name}
              onChange={(e) => setName(e.target.value)}
              required
            />

            <label className={styles.label} htmlFor="message">Message :</label>
            <textarea
              name="message"
              id="message"
              placeholder="Votre message"
              value={message}
              onChange={(e) => setMessage(e.target.value)}
              required
            />

            <button type="submit" className="button">Envoyer directement depuis votre boite mail</button>
          </form>
        </div>
      )}
    </>
  );
}