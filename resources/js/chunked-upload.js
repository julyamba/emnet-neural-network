import { useForm } from "@inertiajs/vue3";

const chunkSize = 1024 * 1024; // 1MB chunks

export function initializeUpload(fileInputId, progressBarId, statusMessageId) {
    const fileInput = document.getElementById(fileInputId);
    const progressBar = document.getElementById(progressBarId);
    const statusMessage = document.getElementById(statusMessageId);

    if (!fileInput || !progressBar || !statusMessage) {
        console.error("One or more required elements not found");
        return;
    }

    function randomString(length) {
        const characters =
            "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        let result = "";
        const charactersLength = characters.length;
        for (let i = 0; i < length; i++) {
            result += characters.charAt(
                Math.floor(Math.random() * charactersLength)
            );
        }
        return result;
    }

    function uploadFile(file, onProgress, onComplete, onError) {
        const totalChunks = Math.ceil(file.size / chunkSize);
        let currentChunk = 0;

        const form = useForm({
            file: null,
            name: randomString(32) + "." + file.name.split(".").pop(),
            chunk: 0,
            totalChunks: totalChunks,
        });

        function uploadNextChunk() {
            const start = currentChunk * chunkSize;
            const end = Math.min(start + chunkSize, file.size);
            const chunk = file.slice(start, end);

            form.file = chunk;
            form.chunk = currentChunk;

            form.post("/upload", {
                forceFormData: true,
                preserveScroll: true,
                onFinish: () => {
                    currentChunk++;
                    const progress = (currentChunk / totalChunks) * 100;
                    onProgress(progress);

                    if (currentChunk < totalChunks) {
                        uploadNextChunk();
                    } else {
                        onComplete();
                    }
                },
                onError: (error) => {
                    onError(form.errors);
                },
            });
        }
        uploadNextChunk();
    }

    fileInput.addEventListener("change", function (e) {
        const file = e.target.files[0];
        if (!file) return;

        uploadFile(
            file,
            (progress) => {
                progressBar.style.width = progress + "%";
                progressBar.style.textAlign = "right";
                progressBar.style.paddingRight = "10px";
                progressBar.textContent = Math.round(progress) + "%";
            },
            (data) => {
                statusMessage.textContent = "Upload complete!";
                console.log("Upload complete:", data);
            },
            (error) => {
                statusMessage.textContent = "Upload failed.";
                console.error("Upload error:", error);
            }
        );
    });
}
