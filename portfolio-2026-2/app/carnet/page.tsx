'use client'; // Indique que c'est un composant interactif (Client Component)

import { useState } from 'react';
import Link from "next/link";
import projetsData from "@/data/projets.json";
import styles from './carnet.module.css';

export default function Projet() {
  // On stocke l'ID (ou l'index) de l'onglet actif dans un State
  const [activeTab, setActiveTab] = useState(0);

  return (
    <div className={styles.tabs}>
      <h3 id="tablist-1">Mes Projets</h3>
      
      {/* Barre d'onglets */}
      <div role="tablist" aria-labelledby="tablist-1" className={styles.manual}>
        {projetsData.map((projet, index) => (
          <button
            key={index}
            type="button"
            role="tab"
            aria-selected={activeTab === index}
            aria-controls={`tabpanel-${index}`}
            onClick={() => setActiveTab(index)}
          >
            <span className={styles.focus}>{projet.titre || `Projet ${index + 1}`}</span>
          </button>
        ))}
      </div>

      {/* Contenu des panneaux (s'affiche dynamiquement selon l'onglet actif) */}
      {projetsData.map((projet, index) => (
        <div
          key={index}
          id={`tabpanel-${index}`}
          role="tabpanel"
          aria-labelledby={`tab-${index}`}
          className={activeTab === index ? '' : styles.isHidden}
        >
          <p>
            {projet.description}
          </p>
          {projet.lien && (
            <Link href={projet.lien}>Voir le projet</Link>
          )}
        </div>
      ))}
    </div>
  );
}