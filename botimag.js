document.getElementById("chatbot").addEventListener("click", function() {
    document.getElementById("chat-container").style.right = "20px";
});

document.getElementById("close-chat").addEventListener("click", function() {
    document.getElementById("chat-container").style.right = "-500px";
});
// document.getElementById("chatbot").addEventListener("click", function() {
//     document.getElementById("chat-container").style.right = "-500px";
// });
 const API_KEY = "AIzaSyBLoVssOFRozRvSjEOXfhWhOScICdMZbWE"; // Replace with your actual API key
        const API_URL = `https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key=AIzaSyBLoVssOFRozRvSjEOXfhWhOScICdMZbWE`;

        async function getGeminiResponse(userMessage) {
            const requestBody = { contents: [{ role: "user", parts: [{ text: userMessage }] }] };

            try {
                const response = await fetch(API_URL, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(requestBody),
                });

                const data = await response.json();
                return data.candidates[0]?.content?.parts[0]?.text || "No response received.";
            } catch (error) {
                console.error("Error fetching response:", error);
                return "Error in chatbot response.";
            }
        }

        document.getElementById("send-btn").addEventListener("click", sendMessage);

// Allow Enter key to send the message
document.getElementById("user-input").addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        event.preventDefault(); // Prevents accidental form submission (if inside a form)
        sendMessage();
    }
});

async function sendMessage() {
    const userInput = document.getElementById("user-input").value.trim(); // Trim input
    if (!userInput) return; // Prevent sending empty messages

    const chatBox = document.getElementById("chat-box");
    chatBox.innerHTML += `<p><b>You:</b> ${userInput}</p>`;

    try {
        const botResponse = await getGeminiResponse(userInput);
        chatBox.innerHTML += `<p><b>Bot:</b> ${botResponse}</p>`;
    } catch (error) {
        chatBox.innerHTML += `<p><b>Bot:</b> Error fetching response.</p>`;
        console.error("Error fetching response:", error);
    }

    document.getElementById("user-input").value = ""; // Clear input field
};
