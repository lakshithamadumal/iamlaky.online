<?php
session_start();
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Project | Laky</title>
        <!--favicon icon-->
        <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://unpkg.com/lucide@latest"></script>
        <style>
        body { font-family: 'Poppins', sans-serif; background-color: #0D1725; }
        .main-content { margin-left: 30px; }
        .preview-card { transition: all 0.3s ease; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        </style>
    </head>
    <body class="min-h-screen text-white flex">
        <!-- Sidebar (same as dashboard) -->
        <div class="sidebar fixed h-full bg-[#0D1725] border-r border-white/10 p-4">
            <!-- Same sidebar content as dashboard --></div>
        <!-- Main Content -->
        <div class="main-content flex-1 p-8">
            <header class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold">Add New Project</h1>
                <a href="dashboard.php" class="text-sm bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg flex items-center gap-2">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Back to Dashboard
                </a>
            </header>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Form -->
                <div>
                    <form id="projectForm" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-1">Project Type</label>
                            <div class="flex gap-4">
                                <label class="flex-1">
                                    <input
                                        type="radio"
                                        name="project_type"
                                        value="image"
                                        class="hidden peer"
                                        checked
                                    >
                                    <div class="p-4 border border-white/10 rounded-lg peer-checked:border-[#A7FCEE] peer-checked:bg-[#A7FCEE]/10 cursor-pointer">
                                        <div class="flex items-center gap-3">
                                            <i data-lucide="image" class="w-5 h-5 text-[#A7FCEE]"></i>
                                            <span>Image Project</span>
                                        </div>
                                        <p class="text-xs text-white/60 mt-2">Upload an image for the project card</p>
                                    </div>
                                </label>
                                <label class="flex-1">
                                    <input
                                        type="radio"
                                        name="project_type"
                                        value="gradient"
                                        class="hidden peer"
                                    >
                                    <div class="p-4 border border-white/10 rounded-lg peer-checked:border-[#833AB4] peer-checked:bg-[#833AB4]/10 cursor-pointer">
                                        <div class="flex items-center gap-3">
                                            <i data-lucide="palette" class="w-5 h-5 text-[#833AB4]"></i>
                                            <span>Gradient Project</span>
                                        </div>
                                        <p class="text-xs text-white/60 mt-2">Use a gradient background with SVG</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <!-- Common Fields -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-white/80 mb-1">Project Title</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                required
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#C6FCA6] transition"
                            >
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-white/80 mb-1">Description</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                required
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#C6FCA6] transition"
                            ></textarea>
                        </div>
                        <!-- Image Project Fields -->
                        <div id="imageFields" class="tab-content active space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-white/80 mb-1">Project Image</label>
                                <div class="border-2 border-dashed border-white/10 rounded-lg p-6 text-center">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <i data-lucide="upload" class="w-8 h-8 text-white/60"></i>
                                        <p class="text-sm text-white/60">Click to upload or drag and drop</p>
                                        <p class="text-xs text-white/40 mt-1">PNG, JPG (Recommended: 800x600)</p>
                                    </div>
                                    <input
                                        type="file"
                                        id="projectImage"
                                        name="project_image"
                                        accept="image/*"
                                        class="hidden"
                                    >
                                </div>
                            </div>
                        </div>
                        <!-- Gradient Project Fields -->
                        <div id="gradientFields" class="tab-content space-y-6">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="gradientStart" class="block text-sm font-medium text-white/80 mb-1">Gradient Start</label>
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="color"
                                            id="gradientStart"
                                            name="gradient_start"
                                            value="#833AB4"
                                            class="w-10 h-10 rounded border border-white/10 cursor-pointer"
                                        >
                                        <input
                                            type="text"
                                            id="gradientStartHex"
                                            name="gradient_start_hex"
                                            value="#833AB4"
                                            class="flex-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white"
                                        >
                                    </div>
                                </div>
                                <div>
                                    <label for="gradientEnd" class="block text-sm font-medium text-white/80 mb-1">Gradient End</label>
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="color"
                                            id="gradientEnd"
                                            name="gradient_end"
                                            value="#FD1D1D"
                                            class="w-10 h-10 rounded border border-white/10 cursor-pointer"
                                        >
                                        <input
                                            type="text"
                                            id="gradientEndHex"
                                            name="gradient_end_hex"
                                            value="#FD1D1D"
                                            class="flex-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="svgCode" class="block text-sm font-medium text-white/80 mb-1">SVG Code</label>
                                <textarea
                                    id="svgCode"
                                    name="svg_code"
                                    rows="6"
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white font-mono text-sm focus:outline-none focus:ring-2 focus:ring-[#C6FCA6] transition"
                                ></textarea>
                                <p class="text-xs text-white/40 mt-1">Paste your SVG code here (optional)</p>
                            </div>
                        </div>
                        <!-- Links Section -->
                        <div class="border-t border-white/10 pt-6 space-y-6">
                            <h3 class="text-lg font-medium">Project Links</h3>
                            <!-- Live Link (required) -->
                            <div>
                                <label for="liveLink" class="block text-sm font-medium text-white/80 mb-1 flex items-center gap-2">
                                    Live Link
                                    <span class="text-xs bg-[#C6FCA6]/20 text-[#C6FCA6] px-2 py-0.5 rounded">Required</span>
                                </label>
                                <input
                                    type="url"
                                    id="liveLink"
                                    name="live_link"
                                    required
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#C6FCA6] transition"
                                    placeholder="https://example.com"
                                >
                            </div>
                            <!-- LinkedIn Link (optional) -->
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <label for="linkedinLink" class="block text-sm font-medium text-white/80 flex items-center gap-2">
                                        LinkedIn Link
                                        <span class="text-xs bg-white/10 text-white/60 px-2 py-0.5 rounded">Optional</span>
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input
                                            type="checkbox"
                                            id="hasLinkedin"
                                            name="has_linkedin"
                                            class="sr-only peer"
                                        >
                                        <div class="relative w-9 h-5 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-white/30 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#C6FCA6]"></div>
                                    </label>
                                </div>
                                <input
                                    type="url"
                                    id="linkedinLink"
                                    name="linkedin_link"
                                    disabled
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white/50 focus:outline-none focus:ring-2 focus:ring-[#C6FCA6] transition"
                                    placeholder="https://linkedin.com/example"
                                >
                            </div>
                            <!-- GitHub Link (optional) -->
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <label for="githubLink" class="block text-sm font-medium text-white/80 flex items-center gap-2">
                                        GitHub Link
                                        <span class="text-xs bg-white/10 text-white/60 px-2 py-0.5 rounded">Optional</span>
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input
                                            type="checkbox"
                                            id="hasGithub"
                                            name="has_github"
                                            class="sr-only peer"
                                        >
                                        <div class="relative w-9 h-5 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-white/30 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#C6FCA6]"></div>
                                    </label>
                                </div>
                                <input
                                    type="url"
                                    id="githubLink"
                                    name="github_link"
                                    disabled
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white/50 focus:outline-none focus:ring-2 focus:ring-[#C6FCA6] transition"
                                    placeholder="https://github.com/example"
                                >
                            </div>
                            <!-- Download Link (optional) -->
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <label for="downloadLink" class="block text-sm font-medium text-white/80 flex items-center gap-2">
                                        Download Link
                                        <span class="text-xs bg-white/10 text-white/60 px-2 py-0.5 rounded">Optional</span>
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input
                                            type="checkbox"
                                            id="hasDownload"
                                            name="has_download"
                                            class="sr-only peer"
                                        >
                                        <div class="relative w-9 h-5 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-white/30 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#C6FCA6]"></div>
                                    </label>
                                </div>
                                <input
                                    type="url"
                                    id="downloadLink"
                                    name="download_link"
                                    disabled
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white/50 focus:outline-none focus:ring-2 focus:ring-[#C6FCA6] transition"
                                    placeholder="https://example.com/download"
                                >
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-gradient-to-r from-[#C6FCA6] to-[#A7FCEE] text-black font-medium py-3 px-4 rounded-lg hover:opacity-90 transition flex items-center justify-center gap-2">
                                Save Project
                                <i data-lucide="save" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Preview -->
                <div class="sticky top-8 h-fit">
                    <div class="bg-white/5 rounded-xl border border-white/10 p-6">
                        <h3 class="text-lg font-medium mb-4">Project Preview</h3>
                        <div id="previewContainer" class="preview-card">
                            <!-- Preview will be updated dynamically -->
                            <div class="flex flex-col group">
                                <div class="w-full h-64 bg-gradient-to-br from-[#833AB4] to-[#FD1D1D] flex justify-center items-center relative rounded-xl overflow-hidden">
                                    <svg
                                        width="65"
                                        height="67"
                                        viewBox="0 0 65 67"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M59.8911 0.186035L36.5451 36.8812L33.3145 20.789H0.886215L59.8911 0.186035ZM5.7628 66.7493L29.1087 30.0542L32.3394 46.1464H64.7676L5.7628 66.7493Z"
                                            fill="#EEE"
                                        />
                                    </svg>
                                    <a href="#" target="_blank" class="absolute top-4 right-4 opacity-100 transition-all bg-black/60 hover:bg-black text-white rounded-full px-3 py-1 flex items-center gap-1 text-sm">
                                        Live
                                        <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                                    </a>
                                </div>
                                <p class="mt-6 mb-6 text-sm sm:text-base text-white font-weight: 650">
                                    This is a preview of how your project will appear on your portfolio.
                                </p>
                                <div class="flex gap-6">
                                    <a href="#" target="_blank" class="text-white/70 hover:bg-[#c6fca6] hover:text-black flex items-center btn-animate font-weight: 650">
                                        Linkedin
                                        <i data-lucide="arrow-up-right" class="w-4 h-4 ml-1"></i>
                                    </a>
                                    <a href="#" target="_blank" class="text-white/70 hover:bg-[#c6fca6] hover:text-black flex items-center btn-animate font-weight: 650">
                                        GitHub
                                        <i data-lucide="arrow-up-right" class="w-4 h-4 ml-1"></i>
                                    </a>
                                    <a href="#" target="_blank" class="text-white/70 hover:bg-[#c6fca6] hover:text-black flex items-center btn-animate font-weight: 650">
                                        Download
                                        <i data-lucide="arrow-up-right" class="w-4 h-4 ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        lucide.createIcons();
        
        // Toggle between image and gradient fields
        const projectTypeRadios = document.querySelectorAll('input[name="project_type"]');
        const imageFields = document.getElementById('imageFields');
        const gradientFields = document.getElementById('gradientFields');
        
        projectTypeRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'image') {
                    imageFields.classList.add('active');
                    gradientFields.classList.remove('active');
                    updatePreview();
                } else {
                    imageFields.classList.remove('active');
                    gradientFields.classList.add('active');
                    updatePreview();
                }
            });
        });
        
        // Color picker sync with hex input
        document.getElementById('gradientStart').addEventListener('input', (e) => {
            document.getElementById('gradientStartHex').value = e.target.value;
            updatePreview();
        });
        
        document.getElementById('gradientEnd').addEventListener('input', (e) => {
            document.getElementById('gradientEndHex').value = e.target.value;
            updatePreview();
        });
        
        document.getElementById('gradientStartHex').addEventListener('input', (e) => {
            if (/^#[0-9A-F]{6}$/i.test(e.target.value)) {
                document.getElementById('gradientStart').value = e.target.value;
                updatePreview();
            }
        });
        
        document.getElementById('gradientEndHex').addEventListener('input', (e) => {
            if (/^#[0-9A-F]{6}$/i.test(e.target.value)) {
                document.getElementById('gradientEnd').value = e.target.value;
                updatePreview();
            }
        });
        
        // Toggle optional link fields
        document.getElementById('hasLinkedin').addEventListener('change', (e) => {
            document.getElementById('linkedinLink').disabled = !e.target.checked;
            updatePreview();
        });
        
        document.getElementById('hasGithub').addEventListener('change', (e) => {
            document.getElementById('githubLink').disabled = !e.target.checked;
            updatePreview();
        });
        
        document.getElementById('hasDownload').addEventListener('change', (e) => {
            document.getElementById('downloadLink').disabled = !e.target.checked;
            updatePreview();
        });
        
        // Image upload preview
        document.querySelector('.border-dashed').addEventListener('click', () => {
            document.getElementById('projectImage').click();
        });
        
        document.getElementById('projectImage').addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const reader = new FileReader();
                
                reader.onload = (event) => {
                    updatePreview();
                };
                
                reader.readAsDataURL(file);
            }
        });
        
        // Update preview in real-time
        function updatePreview() {
            const previewContainer = document.getElementById('previewContainer');
            const projectType = document.querySelector('input[name="project_type"]:checked').value;
            const title = document.getElementById('title').value || 'Project Title';
            const description = document.getElementById('description').value || 'This is a preview of how your project will appear on your portfolio.';
            const liveLink = document.getElementById('liveLink').value || '#';
            
            let previewHTML = `
                <div class="flex flex-col group">
                    <div class="w-full h-64 ${projectType === 'image' ? 'bg-white/10' : `bg-gradient-to-br from-[${document.getElementById('gradientStart').value}] to-[${document.getElementById('gradientEnd').value}]`} flex justify-center items-center relative rounded-xl overflow-hidden">
            `;
            
            if (projectType === 'image') {
                const fileInput = document.getElementById('projectImage');
                if (fileInput.files.length > 0) {
                    previewHTML += `<img src="${URL.createObjectURL(fileInput.files[0])}" alt="${title}" class="w-full h-full object-cover">`;
                } else {
                    previewHTML += `<i data-lucide="image" class="w-12 h-12 text-white/30"></i>`;
                }
            } else {
                const svgCode = document.getElementById('svgCode').value;
                if (svgCode) {
                    previewHTML += svgCode;
                } else {
                    previewHTML += `<svg width="65" height="67" viewBox="0 0 65 67" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M59.8911 0.186035L36.5451 36.8812L33.3145 20.789H0.886215L59.8911 0.186035ZM5.7628 66.7493L29.1087 30.0542L32.3394 46.1464H64.7676L5.7628 66.7493Z" fill="#EEE"/>
                    </svg>`;
                }
            }
            
            previewHTML += `
                        <a href="${liveLink}" target="_blank" class="absolute top-4 right-4 opacity-100 transition-all bg-black/60 hover:bg-black text-white rounded-full px-3 py-1 flex items-center gap-1 text-sm">
                            Live
                            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                    <p class="mt-6 mb-6 text-sm sm:text-base text-white font-weight: 650">
                        ${description}
                    </p>
                    <div class="flex gap-6">
            `;
            
            if (document.getElementById('hasLinkedin').checked) {
                const linkedinLink = document.getElementById('linkedinLink').value || '#';
                previewHTML += `
                    <a href="${linkedinLink}" target="_blank" class="text-white/70 hover:bg-[#c6fca6] hover:text-black flex items-center btn-animate font-weight: 650">
                        Linkedin
                        <i data-lucide="arrow-up-right" class="w-4 h-4 ml-1"></i>
                    </a>
                `;
            }
            
            if (document.getElementById('hasGithub').checked) {
                const githubLink = document.getElementById('githubLink').value || '#';
                previewHTML += `
                    <a href="${githubLink}" target="_blank" class="text-white/70 hover:bg-[#c6fca6] hover:text-black flex items-center btn-animate font-weight: 650">
                        GitHub
                        <i data-lucide="arrow-up-right" class="w-4 h-4 ml-1"></i>
                    </a>
                `;
            }
            
            if (document.getElementById('hasDownload').checked) {
                const downloadLink = document.getElementById('downloadLink').value || '#';
                previewHTML += `
                    <a href="${downloadLink}" target="_blank" class="text-white/70 hover:bg-[#c6fca6] hover:text-black flex items-center btn-animate font-weight: 650">
                        Download
                        <i data-lucide="arrow-up-right" class="w-4 h-4 ml-1"></i>
                    </a>
                `;
            }
            
            previewHTML += `
                    </div>
                </div>
            `;
            
            previewContainer.innerHTML = previewHTML;
            lucide.createIcons();
        }
        
        // Form submission
        document.getElementById('projectForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData();
            const projectType = document.querySelector('input[name="project_type"]:checked').value;
            
            // Add common fields
            formData.append('title', document.getElementById('title').value);
            formData.append('description', document.getElementById('description').value);
            formData.append('project_type', projectType);
            formData.append('live_link', document.getElementById('liveLink').value);
            
            // Add type-specific fields
            if (projectType === 'image') {
                const fileInput = document.getElementById('projectImage');
                if (fileInput.files.length > 0) {
                    formData.append('project_image', fileInput.files[0]);
                }
            } else {
                formData.append('gradient_start', document.getElementById('gradientStart').value);
                formData.append('gradient_end', document.getElementById('gradientEnd').value);
                formData.append('svg_code', document.getElementById('svgCode').value);
            }
            
            // Add optional links
            formData.append('has_linkedin', document.getElementById('hasLinkedin').checked);
            if (document.getElementById('hasLinkedin').checked) {
                formData.append('linkedin_link', document.getElementById('linkedinLink').value);
            }
            
            formData.append('has_github', document.getElementById('hasGithub').checked);
            if (document.getElementById('hasGithub').checked) {
                formData.append('github_link', document.getElementById('githubLink').value);
            }
            
            formData.append('has_download', document.getElementById('hasDownload').checked);
            if (document.getElementById('hasDownload').checked) {
                formData.append('download_link', document.getElementById('downloadLink').value);
            }
            
            try {
                // Show progress bar
                Swal.fire({
                    title: 'Saving...',
                    html: '<div class="w-full bg-gray-200 rounded-full h-2.5"><div class="bg-[#C6FCA6] h-2.5 rounded-full w-3/4 animate-pulse"></div></div>',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });

                const response = await fetch('/admin/api/projects.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    Swal.fire('Success!', 'Project added successfully.', 'success')
                        .then(() => window.location.href = '/admin/dashboard.php');
                } else {
                    Swal.fire('Error', data.message || 'Error saving project', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire('Error', 'An error occurred while saving the project', 'error');
            }
        });
        
        // Session check (absolute path)
        fetch('/admin/api/session.php')
            .then(res => res.json())
            .then(data => {
                if (!data.logged_in) window.location.href = '/admin/login.php';
            });
        
        // Initialize preview
        updatePreview();
        
        // Update preview when any field changes
        document.querySelectorAll('#projectForm input, #projectForm textarea').forEach(element => {
            element.addEventListener('input', updatePreview);
        });
        </script>
    </body>
</html>
