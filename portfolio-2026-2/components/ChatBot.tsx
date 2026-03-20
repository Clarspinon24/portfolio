
"use client";
 
import { useState, useRef, useEffect } from "react";
import styles from "./chatbot.module.css";
 
type Message = {
  role: "user" | "assistant";
  content: string;
};
 
export default function ChatBot() {
  const [messages, setMessages] = useState<Message[]>([]);
  const [input, setInput] = useState("");
  const [loading, setLoading] = useState(false);
  const bottomRef = useRef<HTMLDivElement>(null);
 
  useEffect(() => {
    bottomRef.current?.scrollIntoView({ behavior: "smooth" });
  }, [messages, loading]);
 
  const sendMessage = async () => {
    const text = input.trim();
    if (!text || loading) return;
 
    const newMessages: Message[] = [...messages, { role: "user", content: text }];
    setMessages(newMessages);
    setInput("");
    setLoading(true);
 
    try {
      const res = await fetch("/api/chat", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ messages: newMessages }),
      });
 
      const data = await res.json();
 
      if (data.error) {
        setMessages((prev) => [...prev, { role: "assistant", content: "⚠ " + data.error }]);
      } else {
        setMessages((prev) => [...prev, { role: "assistant", content: data.message }]);
      }
    } catch {
      setMessages((prev) => [...prev, { role: "assistant", content: "⚠ Erreur réseau." }]);
    } finally {
      setLoading(false);
    }
  };
 
  const handleKeyDown = (e: React.KeyboardEvent<HTMLTextAreaElement>) => {
    if (e.key === "Enter" && !e.shiftKey) {
      e.preventDefault();
      sendMessage();
    }
  };
 
  return (
    <div className={styles.wrapper}>
      {/* Header */}
      <div className={styles.header}>
        <span className={styles.headerIcon}>✦</span>
        <span className={styles.headerTitle}>Vous avez des questions ?</span>
        {messages.length > 0 && (
          <button className={styles.clearBtn} onClick={() => setMessages([])}>
            ↺ Réinitialiser
          </button>
        )}
      </div>
 
      {/* Messages */}
      <div className={styles.messages}>
        {messages.length === 0 && (
          <div className={styles.emptyState}>
            <div style={{ fontSize: "2.5rem" }}>✦</div>
            <p style={{ color: "#ffffff", marginTop: 8 }}>Commence une conversation…</p>
          </div>
        )}
 
        {messages.map((msg, i) => (
          <div
            key={i}
            className={`${styles.messageRow} ${msg.role === "user" ? styles.user : styles.bot}`}
          >
            {msg.role === "assistant" && (
              <div className={styles.avatarBot}>✦</div>
            )}
            <div className={`${styles.bubble} ${msg.role === "user" ? styles.bubbleUser : styles.bubbleBot}`}>
              {msg.content}
            </div>
            {msg.role === "user" && (
              <div className={styles.avatarUser}>🪼</div>
            )}
          </div>
        ))}
 
        {loading && (
          <div className={`${styles.messageRow} ${styles.bot}`}>
            <div className={styles.avatarBot}>✦</div>
            <div className={`${styles.bubble} ${styles.bubbleBot}`}>
              <span className={styles.dots}>
                <span></span>
                <span></span>
                <span></span>
              </span>
            </div>
          </div>
        )}
 
        <div ref={bottomRef} />
      </div>
 
      {/* Input */}
      <div className={styles.inputBar}>
        <textarea
          className={styles.textarea}
          placeholder="Envoie un message… (Entrée pour envoyer)"
          value={input}
          onChange={(e) => setInput(e.target.value)}
          onKeyDown={handleKeyDown}
          rows={1}
        />
        <button
          className={styles.sendBtn}
          onClick={sendMessage}
          disabled={loading || !input.trim()}
        >
          ➤
        </button>
      </div>
    </div>
  );
}