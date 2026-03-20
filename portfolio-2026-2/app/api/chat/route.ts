import { NextRequest, NextResponse } from "next/server";

export async function POST(req: NextRequest) {
  const { messages } = await req.json();

  if (!messages || !Array.isArray(messages)) {
    return NextResponse.json({ error: "Messages invalides" }, { status: 400 });
  }

  try {
    const response = await fetch("https://openrouter.ai/api/v1/chat/completions", {
      method: "POST",
      headers: {
        "Authorization": `Bearer ${process.env.OPENROUTER_API_KEY}`,
        "Content-Type": "application/json",
        "HTTP-Referer": process.env.NEXT_PUBLIC_APP_URL || "http://localhost:3000",
        "X-Title": "Portfolio Chatbot",
      },
      body: JSON.stringify({
        model: process.env.OPENROUTER_MODEL || "mistralai/mistral-small-2603",
        messages: [
          {
            role: "system",
            content: "Tu es un assistant de portfolio, tu reponds au questions des visiteurs sur mon contenu et mes compétences. Réponds en français de manière claire et concise.",
          },
          ...messages,
        ],
        max_tokens: 1024,
        temperature: 0.7,
      }),
    });

    if (!response.ok) {
      const error = await response.text();
      return NextResponse.json({ error }, { status: response.status });
    }

    const data = await response.json();
    const reply = data.choices?.[0]?.message?.content ?? "Aucune réponse.";

    return NextResponse.json({ message: reply, model: data.model });
  } catch (err) {
    return NextResponse.json({ error: "Erreur serveur : " + err }, { status: 500 });
  }
}
