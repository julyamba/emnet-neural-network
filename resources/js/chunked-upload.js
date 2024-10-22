// chunked-upload.js
import { useForm } from "@inertiajs/vue3";

const chunkSize = 1024 * 1024; // 1MB chunks

export function initializeUpload(
    fileInputId,
    progressContainerId,
    statusMessageId
) {
    const fileInput = document.getElementById(fileInputId);
    const progressContainer = document.getElementById(progressContainerId);
    const statusMessage = document.getElementById(statusMessageId);

    if (!fileInput || !progressContainer || !statusMessage) {
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

    function createProgressBar(file) {
        const progressBarWrapper = document.createElement("div");
        progressBarWrapper.className = "mb-4";

        const fileNameDiv = document.createElement("div");
        fileNameDiv.className = "text-sm mb-1";
        fileNameDiv.textContent = file.name;

        const progressBarContainer = document.createElement("div");
        progressBarContainer.className =
            "w-full bg-gray-200 rounded-full h-5 dark:bg-gray-700";

        const progressBar = document.createElement("div");
        progressBar.className = "bg-blue-600 h-5 rounded-full text-sm";
        progressBar.style.width = "0%";

        progressBarContainer.appendChild(progressBar);
        progressBarWrapper.appendChild(fileNameDiv);
        progressBarWrapper.appendChild(progressBarContainer);

        return { wrapper: progressBarWrapper, bar: progressBar };
    }

    async function uploadFile(file, progressBar, progressBarWrapper) {
        const totalChunks = Math.ceil(file.size / chunkSize);
        let currentChunk = 0;

        const form = useForm({
            file: null,
            name: randomString(32) + "." + file.name.split(".").pop(),
            chunk: 0,
            totalChunks: totalChunks,
            originalName: file.name,
        });

        return new Promise((resolve, reject) => {
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
                        progressBar.style.width = progress + "%";
                        progressBar.style.textAlign = "right";
                        progressBar.style.paddingRight = "10px";
                        progressBar.textContent = Math.round(progress) + "%";

                        if (currentChunk < totalChunks) {
                            uploadNextChunk();
                        } else {
                            progressBarWrapper.style.display = "none";
                            resolve();
                        }
                    },
                    onError: (error) => {
                        reject(error);
                    },
                });
            }
            uploadNextChunk();
        });
    }

    fileInput.addEventListener("change", async function (e) {
        const files = Array.from(e.target.files);
        if (files.length === 0) return;

        // Clear previous progress bars
        progressContainer.innerHTML = "";
        statusMessage.textContent = "";

        try {
            for (const file of files) {
                const { wrapper, bar } = createProgressBar(file);
                progressContainer.appendChild(wrapper);
                await uploadFile(file, bar, wrapper);
            }
            statusMessage.textContent = "All uploads complete!";
            // Refresh the page or emit an event to update the video list
            window.location.reload();
        } catch (error) {
            statusMessage.textContent = "One or more uploads failed.";
            console.error("Upload error:", error);
        }
    });
}
