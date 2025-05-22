# -*- coding: utf-8 -*-
import sys
from transformers import AutoTokenizer, AutoModelForCausalLM
import torch

model_path = r"C:\Users\intel\Documents\Stage d'initiation\bloom-560m"

# Chargement du modèle et du tokenizer
tokenizer = AutoTokenizer.from_pretrained(model_path)
model = AutoModelForCausalLM.from_pretrained(model_path)

def generate_response(question):
    try:
        prompt = (
            "Tu es un expert en informatique. Réponds de manière claire et utile.\n"
            f"Q: {question}\nR:"
        )

        inputs = tokenizer(prompt, return_tensors="pt", padding=True)
        output = model.generate(
            inputs["input_ids"],
            attention_mask=inputs["attention_mask"],
            max_new_tokens=100,
            pad_token_id=tokenizer.eos_token_id,
            do_sample=True,
            temperature=0.7,
            top_p=0.9
        )

        response = tokenizer.decode(output[0], skip_special_tokens=True)
        final_response = response.split("R:")[1].strip() if "R:" in response else response.strip()

        # Nettoyage des caractères spéciaux
        return final_response.encode("utf-8", errors="ignore").decode("utf-8", errors="ignore")

    except Exception as e:
        return f"Erreur lors de la génération : {str(e)}"

if __name__ == "__main__":
    if len(sys.argv) > 1:
        question = sys.argv[1]
        answer = generate_response(question)
        print(answer)
    else:
        print("Pas de question fournie")
