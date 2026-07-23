<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Repository - CS402 - CarryOn</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <script src="{{ asset('js/tailwind-config.js') }}"></script>
    <link href="{{ asset('css/student-pages.css') }}" rel="stylesheet">
</head>
<body class="h-full text-gray-900 antialiased font-sans bg-[#F9FAFB] flex flex-col md:flex-row overflow-hidden">

    <!-- Mobile Menu Bar -->
    <div class="md:hidden flex items-center justify-between bg-[#FAF9FB] px-4 py-3 border-b border-gray-200 sticky top-0 z-40">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/carryon_logo_mark_v2.png') }}" class="w-8 h-8 object-contain" alt="CarryOn Logo">
            <span class="font-bold text-base tracking-tight text-gray-900">CarryOn</span>
        </div>
        <button id="mobile-menu-toggle" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg"><span class="material-symbols-outlined">menu</span></button>
    </div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-[#FAF9FB] border-r border-gray-200 flex flex-col transform -translate-x-full md:translate-x-0 md:static transition-transform duration-300 ease-in-out">
        <div class="px-6 py-5 flex items-center gap-3 border-b border-gray-100">
            <a href="/StudentDashboard" class="flex items-center gap-3">
                <img src="{{ asset('images/carryon_logo_mark_v2.png') }}" class="w-9 h-9 object-contain" alt="CarryOn Logo">
                <div>
                    <span class="font-bold text-lg tracking-tight text-gray-900 block">CarryOn</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold block -mt-1">Student Portal</span>
                </div>
            </a>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <a href="/StudentDashboard" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">grid_view</span><span>Dashboard</span>
            </a>
            <div class="pt-3 pb-1.5"><p class="px-3.5 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">CS402</p></div>
            <a href="/student/class/cs402" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">class</span><span>Class Overview</span>
            </a>
            <a href="/student/class/cs402/contribution" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">monitoring</span><span>Contribution</span>
            </a>
            <a href="/student/class/cs402/group-status" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">groups</span><span>Group Status</span>
            </a>
            <a href="/student/class/cs402/leader-vote" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">how_to_vote</span><span>Leader Vote</span>
            </a>
            <a href="/student/class/cs402/task-manager" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">assignment</span><span>Task Manager</span>
            </a>
            <a href="/student/class/cs402/file-repository" class="flex items-center gap-3 px-3.5 py-2.5 bg-gray-900 text-white rounded-lg text-[14px] font-medium pl-9">
                <span class="material-symbols-outlined text-[20px]">folder_open</span><span>File Repository</span>
            </a>
        </nav>
        <div class="p-4 border-t border-gray-150">
            <a href="/login" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">logout</span><span>Log Out</span>
            </a>
        </div>
    </aside>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-20 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto main-scroll">
        <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-gray-100 px-6 lg:px-10 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="/student/class/cs402" class="text-gray-400 hover:text-gray-900 transition-colors"><span class="material-symbols-outlined text-[20px]">arrow_back</span></a>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 tracking-tight">File Repository</h1>
                        <p class="text-sm text-gray-500 mt-0.5">CS402: Distributed Systems · Group Alpha Shared Workspace</p>
                    </div>
                </div>
                <button onclick="showUploadModal()" class="bg-gray-900 text-white px-4 py-2 rounded-lg font-semibold text-sm hover:bg-gray-800 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">upload</span>
                    Upload File
                </button>
            </div>
        </header>

        <div class="px-6 lg:px-10 py-8 max-w-7xl mx-auto">
            <!-- Stats overview -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6 animate-in">
                <div class="bg-white rounded-xl border border-gray-200 p-4 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                        <span class="material-symbols-outlined text-[22px]">folder</span>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold">Total Storage Used</p>
                        <p class="text-xl font-bold text-gray-900">48.3 MB <span class="text-xs font-normal text-gray-400">/ 500 MB</span></p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center text-green-600">
                        <span class="material-symbols-outlined text-[22px]">description</span>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold">Files Shared</p>
                        <p class="text-xl font-bold text-gray-900">12 Files</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600">
                        <span class="material-symbols-outlined text-[22px]">history</span>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold">Last Updated</p>
                        <p class="text-xl font-bold text-gray-900">2 hours ago</p>
                    </div>
                </div>
            </div>

            <!-- Categories / Folders -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8 animate-in animate-in-delay-1">
                <div class="bg-white rounded-xl border border-gray-200 p-4 hover:border-gray-900 transition-colors cursor-pointer group">
                    <div class="flex items-center justify-between mb-2">
                        <span class="material-symbols-outlined text-amber-500 text-[28px]">folder</span>
                        <span class="text-xs text-gray-400">5 files</span>
                    </div>
                    <p class="font-bold text-gray-900 text-sm group-hover:text-blue-600 transition-colors">Documentation</p>
                    <p class="text-xs text-gray-400">18.4 MB</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 hover:border-gray-900 transition-colors cursor-pointer group">
                    <div class="flex items-center justify-between mb-2">
                        <span class="material-symbols-outlined text-blue-500 text-[28px]">folder</span>
                        <span class="text-xs text-gray-400">4 files</span>
                    </div>
                    <p class="font-bold text-gray-900 text-sm group-hover:text-blue-600 transition-colors">Source Code</p>
                    <p class="text-xs text-gray-400">12.1 MB</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 hover:border-gray-900 transition-colors cursor-pointer group">
                    <div class="flex items-center justify-between mb-2">
                        <span class="material-symbols-outlined text-emerald-500 text-[28px]">folder</span>
                        <span class="text-xs text-gray-400">2 files</span>
                    </div>
                    <p class="font-bold text-gray-900 text-sm group-hover:text-blue-600 transition-colors">Designs & Diagrams</p>
                    <p class="text-xs text-gray-400">14.8 MB</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 hover:border-gray-900 transition-colors cursor-pointer group">
                    <div class="flex items-center justify-between mb-2">
                        <span class="material-symbols-outlined text-purple-500 text-[28px]">folder</span>
                        <span class="text-xs text-gray-400">1 file</span>
                    </div>
                    <p class="font-bold text-gray-900 text-sm group-hover:text-blue-600 transition-colors">Submissions</p>
                    <p class="text-xs text-gray-400">3.0 MB</p>
                </div>
            </div>

            <!-- Recent Files Table -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden animate-in animate-in-delay-2">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-gray-900">Shared Files</h3>
                        <p class="text-xs text-gray-500">All uploaded resources accessible to Group Alpha</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="text" placeholder="Search files..." class="border border-gray-200 rounded-lg px-3 py-1.5 text-xs outline-none focus:ring-1 focus:ring-gray-900 w-48">
                    </div>
                </div>

                <div class="divide-y divide-gray-100 overflow-x-auto">
                    <!-- Table Header -->
                    <div class="bg-gray-50/70 px-6 py-2.5 flex items-center text-[10px] uppercase tracking-wider text-gray-400 font-semibold min-w-[600px]">
                        <div class="flex-1">Name</div>
                        <div class="w-32">Uploaded By</div>
                        <div class="w-28">Date</div>
                        <div class="w-24">Size</div>
                        <div class="w-20 text-right">Actions</div>
                    </div>

                    <!-- Row 1 -->
                    <div class="file-row px-6 py-3.5 flex items-center min-w-[600px]">
                        <div class="flex-1 flex items-center gap-3 min-w-0">
                            <span class="material-symbols-outlined text-red-500 text-[22px]">picture_as_pdf</span>
                            <div class="truncate">
                                <p class="text-sm font-semibold text-gray-900 truncate">System_Architecture_v3.pdf</p>
                                <p class="text-[11px] text-gray-400">Documentation</p>
                            </div>
                        </div>
                        <div class="w-32 text-xs text-gray-600 font-medium">Alex Rivera</div>
                        <div class="w-28 text-xs text-gray-400">2 hours ago</div>
                        <div class="w-24 text-xs text-gray-400">4.2 MB</div>
                        <div class="w-20 flex items-center justify-end gap-1">
                            <button onclick="showToast('Downloading System_Architecture_v3.pdf...')" class="p-1.5 text-gray-400 hover:text-gray-900 rounded-lg hover:bg-gray-100"><span class="material-symbols-outlined text-[18px]">download</span></button>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="file-row px-6 py-3.5 flex items-center min-w-[600px]">
                        <div class="flex-1 flex items-center gap-3 min-w-0">
                            <span class="material-symbols-outlined text-blue-500 text-[22px]">folder_zip</span>
                            <div class="truncate">
                                <p class="text-sm font-semibold text-gray-900 truncate">api-gateway-src.zip</p>
                                <p class="text-[11px] text-gray-400">Source Code</p>
                            </div>
                        </div>
                        <div class="w-32 text-xs text-gray-600 font-medium">Alex Rivera</div>
                        <div class="w-28 text-xs text-gray-400">Yesterday</div>
                        <div class="w-24 text-xs text-gray-400">8.1 MB</div>
                        <div class="w-20 flex items-center justify-end gap-1">
                            <button onclick="showToast('Downloading api-gateway-src.zip...')" class="p-1.5 text-gray-400 hover:text-gray-900 rounded-lg hover:bg-gray-100"><span class="material-symbols-outlined text-[18px]">download</span></button>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="file-row px-6 py-3.5 flex items-center min-w-[600px]">
                        <div class="flex-1 flex items-center gap-3 min-w-0">
                            <span class="material-symbols-outlined text-emerald-500 text-[22px]">image</span>
                            <div class="truncate">
                                <p class="text-sm font-semibold text-gray-900 truncate">database-schema-diagram.png</p>
                                <p class="text-[11px] text-gray-400">Designs & Diagrams</p>
                            </div>
                        </div>
                        <div class="w-32 text-xs text-gray-600 font-medium">James Tan</div>
                        <div class="w-28 text-xs text-gray-400">Oct 20, 2024</div>
                        <div class="w-24 text-xs text-gray-400">2.4 MB</div>
                        <div class="w-20 flex items-center justify-end gap-1">
                            <button onclick="showToast('Downloading database-schema-diagram.png...')" class="p-1.5 text-gray-400 hover:text-gray-900 rounded-lg hover:bg-gray-100"><span class="material-symbols-outlined text-[18px]">download</span></button>
                        </div>
                    </div>

                    <!-- Row 4 -->
                    <div class="file-row px-6 py-3.5 flex items-center min-w-[600px]">
                        <div class="flex-1 flex items-center gap-3 min-w-0">
                            <span class="material-symbols-outlined text-purple-500 text-[22px]">description</span>
                            <div class="truncate">
                                <p class="text-sm font-semibold text-gray-900 truncate">Requirements_Specification.docx</p>
                                <p class="text-[11px] text-gray-400">Documentation</p>
                            </div>
                        </div>
                        <div class="w-32 text-xs text-gray-600 font-medium">Sofia Lim</div>
                        <div class="w-28 text-xs text-gray-400">Oct 18, 2024</div>
                        <div class="w-24 text-xs text-gray-400">1.8 MB</div>
                        <div class="w-20 flex items-center justify-end gap-1">
                            <button onclick="showToast('Downloading Requirements_Specification.docx...')" class="p-1.5 text-gray-400 hover:text-gray-900 rounded-lg hover:bg-gray-100"><span class="material-symbols-outlined text-[18px]">download</span></button>
                        </div>
                    </div>

                    <!-- Row 5 -->
                    <div class="file-row px-6 py-3.5 flex items-center min-w-[600px]">
                        <div class="flex-1 flex items-center gap-3 min-w-0">
                            <span class="material-symbols-outlined text-amber-500 text-[22px]">movie</span>
                            <div class="truncate">
                                <p class="text-sm font-semibold text-gray-900 truncate">Phase1_Demo_Walkthrough.mp4</p>
                                <p class="text-[11px] text-gray-400">Submissions</p>
                            </div>
                        </div>
                        <div class="w-32 text-xs text-gray-600 font-medium">Maria Cruz</div>
                        <div class="w-28 text-xs text-gray-400">Oct 15, 2024</div>
                        <div class="w-24 text-xs text-gray-400">22.5 MB</div>
                        <div class="w-20 flex items-center justify-end gap-1">
                            <button onclick="showToast('Downloading Phase1_Demo_Walkthrough.mp4...')" class="p-1.5 text-gray-400 hover:text-gray-900 rounded-lg hover:bg-gray-100"><span class="material-symbols-outlined text-[18px]">download</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="px-6 lg:px-10 py-6 border-t border-gray-100 mt-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-3 max-w-7xl mx-auto">
                <span class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold">CarryOn Academic Systems</span>
                <span class="text-xs text-gray-400">© 2024 CarryOn Academic Systems.</span>
            </div>
        </footer>
    </main>

    <!-- Upload File Modal -->
    <div id="upload-modal" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center">
        <div class="modal-panel bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-lg mx-4 p-6">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600 text-[22px]">cloud_upload</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Upload to Repository</h3>
                        <p class="text-sm text-gray-500">Share files with your group members</p>
                    </div>
                </div>
                <button onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600"><span class="material-symbols-outlined">close</span></button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Select Category / Folder</label>
                    <select class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none bg-white">
                        <option>Documentation</option>
                        <option>Source Code</option>
                        <option>Designs & Diagrams</option>
                        <option>Submissions</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">File Upload</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center hover:border-gray-400 transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-gray-300 text-[36px] mb-2">upload_file</span>
                        <p class="text-sm text-gray-500">Drag & drop files here, or <span class="text-blue-600 font-medium">browse</span></p>
                        <p class="text-xs text-gray-400 mt-1">PDF, ZIP, DOCX, PNG up to 100MB</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-6">
                <button onclick="closeUploadModal()" class="flex-1 px-4 py-2.5 rounded-lg border border-gray-200 text-gray-700 font-semibold text-sm hover:bg-gray-50 transition-colors">Cancel</button>
                <button onclick="uploadFile()" class="flex-1 px-4 py-2.5 rounded-lg bg-gray-900 text-white font-semibold text-sm hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[16px]">upload</span>
                    Upload
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-6 right-6 z-50 bg-green-600 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-3 transform translate-y-20 opacity-0 transition-all duration-300">
        <span class="material-symbols-outlined text-[20px]">check_circle</span>
        <span class="font-medium text-sm" id="toast-msg">File uploaded successfully!</span>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
        }
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', toggleSidebar);

        function showUploadModal() { document.getElementById('upload-modal').classList.add('active'); }
        function closeUploadModal() { document.getElementById('upload-modal').classList.remove('active'); }

        function uploadFile() {
            closeUploadModal();
            showToast('File uploaded to repository successfully!');
        }

        function showToast(msg) {
            const t = document.getElementById('toast');
            document.getElementById('toast-msg').textContent = msg;
            t.classList.remove('translate-y-20', 'opacity-0');
            setTimeout(() => t.classList.add('translate-y-20', 'opacity-0'), 3000);
        }
    </script>
</body>
</html>
