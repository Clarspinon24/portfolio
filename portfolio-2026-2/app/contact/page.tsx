"use client";
import styles from './contact.module.css';

import { useState } from "react";

export default function Contact() {
  const [status, setStatus] = useState("");

  async function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();
    setStatus("Envoi en cours...");

    const formData = new FormData(e.currentTarget);
    const data = {
      name: formData.get("name"),
      email: formData.get("email"),
      message: formData.get("message"),
    };

    try {
      const response = await fetch("/api/contact", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      });

      if (response.ok) {
        setStatus("Message envoyé avec succès !");
        (e.target as HTMLFormElement).reset();
      } else {
        setStatus("Erreur lors de l'envoi.");
      }
    } catch (err) {
      setStatus("Une erreur est survenue.");
    }
  }

  return (
    <div className={styles.contact_container} >
      <h1>Contact</h1>
      <form onSubmit={handleSubmit} className="flex flex-col gap-4">
        <input type="text" name="name" placeholder="Votre nom" required  />
        <input type="email" name="email" placeholder="Votre email" required/>
        <textarea 
          name="message" 
          placeholder="Votre message"
          required
        />
        <button type="submit" >Envoyer le message</button>
      </form>
      {status && <p className='status' >{status}</p>}
    </div>
  );
}