import { NextResponse } from "next/server";
import { Resend } from "resend";

const resend = new Resend(process.env.RESEND_API_KEY);

interface ContactFormData {
  name: string;
  email: string;
  message: string;
}

export async function POST(req: Request) {
  try {
    const body: ContactFormData = await req.json();
    const { name, email, message } = body;

    if (!name || !email || !message) {
      return NextResponse.json(
        { error: "Tous les champs sont requis." },
        { status: 400 }
      );
    }

  
    const { data, error } = await resend.emails.send({
      from: "onboarding@resend.dev", 
      to: "marchal.clara95@gmail.com",
      subject: `Nouveau message de ${name}`,
      html: `
        <div style="font-family: sans-serif;">
          <h2>Nouveau message du portfolio</h2>
          <p><strong>Nom :</strong> ${name}</p>
          <p><strong>Email :</strong> ${email}</p>
          <p><strong>Message :</strong></p>
          <p>${message}</p>
        </div>
      `,
    });

    if (error) {
      return NextResponse.json({ error }, { status: 400 });
    }

    return NextResponse.json({ success: true, id: data?.id });

  } catch (error) {
    console.error("Erreur API Route:", error);
    return NextResponse.json(
      { error: "Une erreur interne est survenue." },
      { status: 500 }
    );
  }
}