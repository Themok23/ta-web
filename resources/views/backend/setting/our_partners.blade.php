@extends('backend.layouts.app')

@section('content')

<style>
    .upload-preview-box {
        position: relative;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background: #f8f9fa;
        transition: all 0.3s ease;
        min-height: 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .upload-preview-box:hover {
        border-color: #0d6efd;
        background: #e7f1ff;
    }

    .upload-preview-box.has-image {
        border-color: #198754;
        background: #fff;
    }

    .preview-image {
        max-width: 100%;
        max-height: 150px;
        border-radius: 6px;
        margin-bottom: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        object-fit: contain;
    }

    .upload-text {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .file-input-wrapper {
        position: relative;
        width: 100%;
    }

    .file-input-wrapper input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        cursor: pointer;
        z-index: 5;
    }

    .btn-choose-file {
        background: #0d6efd;
        color: white;
        padding: 8px 20px;
        border-radius: 6px;
        font-size: 14px;
        display: inline-block;
        cursor: pointer;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .btn-choose-file:hover {
        background: #0b5ed7;
    }

    .btn-remove-image {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .btn-remove-image:hover {
        background: #bb2d3b;
        transform: scale(1.1);
    }

    .section-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid #0d6efd;
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-control, .form-control:focus {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        padding: 10px 15px;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }

    .save-button {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        border: none;
        padding: 12px 40px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        transition: all 0.3s ease;
    }

    .save-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
    }

    /* Brand Items Styling */
    .brand-item {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .brand-item:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-color: #0d6efd;
    }

    .brand-logo-preview {
        max-width: 120px;
        max-height: 60px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 5px;
        object-fit: contain;
    }

    .btn-add-brand {
        background: #28a745;
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-add-brand:hover {
        background: #218838;
        transform: translateY(-2px);
    }

    .btn-remove-brand {
        background: #dc3545;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .btn-remove-brand:hover {
        background: #c82333;
    }
</style>

<div class="container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="bi bi-people-fill me-2"></i>Our Partners Settings
            </h4>
        </div>

        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('settings.our-partners.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ================= Hero Section ================= --}}
                <div class="section-card">
                    <div class="section-header">
                        <h5 class="section-title">Hero Section</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Hero Title</label>
                            <input type="text" class="form-control" name="hero_title"
                                   value="{{ $hero && isset($hero->value['title']) ? $hero->value['title'] : 'Our Partners' }}"
                                   placeholder="Enter hero title">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Hero Subtitle</label>
                            <textarea class="form-control" name="hero_subtitle" rows="4"
                                      placeholder="Enter hero subtitle description">{{ $hero && isset($hero->value['subtitle']) ? $hero->value['subtitle'] : '' }}</textarea>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Hero Image</label>
                            <div class="upload-preview-box {{ ($hero && isset($hero->value['image']) && $hero->value['image']) ? 'has-image' : '' }}" id="hero-preview-box">
                                @if($hero && isset($hero->value['image']) && $hero->value['image'])
                                    <button type="button" class="btn-remove-image" onclick="removeImage('hero')">✕</button>
                                    <img src="{{ asset($hero->value['image']) }}" class="preview-image" id="hero-preview">
                                @endif
                                <div class="upload-text">{{ ($hero && isset($hero->value['image']) && $hero->value['image']) ? 'Click to change image' : 'Click to upload hero image' }}</div>
                                <div class="file-input-wrapper">
                                    <span class="btn-choose-file">Choose Image</span>
                                    <input type="file" name="hero_image" accept="image/*" onchange="previewImage(event, 'hero')">
                                </div>
                            </div>
                            <input type="hidden" name="hero_image_old" value="{{ $hero && isset($hero->value['image']) ? $hero->value['image'] : '' }}">
                        </div>
                    </div>
                </div>

                {{-- ================= Trust Section ================= --}}
                <div class="section-card">
                    <div class="section-header">
                        <h5 class="section-title">Trust Statement</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Trust Text</label>
                            <input type="text" class="form-control" name="trust_text"
                                   value="{{ $trust && isset($trust->value['text']) ? $trust->value['text'] : "The world's best companies trust Trades Axis." }}"
                                   placeholder="Enter trust statement">
                        </div>
                    </div>
                </div>

                {{-- ================= Brands Section ================= --}}
                <div class="section-card">
                    <div class="section-header">
                        <h5 class="section-title">Partner Brands</h5>
                    </div>

                    <div id="brands-container">
                        @if($brands && isset($brands->value['items']) && is_array($brands->value['items']) && count($brands->value['items']) > 0)
                            @foreach($brands->value['items'] as $index => $brand)
                                <div class="brand-item" data-index="{{ $index }}">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label">Brand Name</label>
                                            <input type="text" class="form-control" name="brand_names[{{ $index }}]" 
                                                   value="{{ $brand['name'] ?? '' }}" placeholder="Brand name">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Brand Logo</label>
                                            <input type="file" class="form-control" name="brand_logos[{{ $index }}]" accept="image/*" onchange="previewBrandLogo(event, {{ $index }})">
                                            @if(isset($brand['logo']) && $brand['logo'])
                                                <input type="hidden" name="brand_logo_old[{{ $index }}]" value="{{ $brand['logo'] }}">
                                                <div class="mt-2">
                                                    <img src="{{ asset($brand['logo']) }}" alt="Logo" class="brand-logo-preview" id="brand-logo-{{ $index }}">
                                                </div>
                                            @else
                                                <div class="mt-2" id="brand-logo-preview-{{ $index }}" style="display: none;">
                                                    <img src="" alt="Logo" class="brand-logo-preview" id="brand-logo-{{ $index }}">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <label class="form-label d-block">&nbsp;</label>
                                            <button type="button" class="btn btn-remove-brand" onclick="removeBrand(this)">
                                                <i class="bi bi-trash"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="brand-item" data-index="0">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Brand Name</label>
                                        <input type="text" class="form-control" name="brand_names[0]" placeholder="Brand name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Brand Logo</label>
                                        <input type="file" class="form-control" name="brand_logos[0]" accept="image/*" onchange="previewBrandLogo(event, 0)">
                                        <div class="mt-2" id="brand-logo-preview-0" style="display: none;">
                                            <img src="" alt="Logo" class="brand-logo-preview" id="brand-logo-0">
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <label class="form-label d-block">&nbsp;</label>
                                        <button type="button" class="btn btn-remove-brand" onclick="removeBrand(this)">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <button type="button" class="btn btn-add-brand mt-3" onclick="addBrand()">
                        <i class="bi bi-plus-circle me-2"></i>Add Brand
                    </button>
                </div>

                {{-- ================= Count Section ================= --}}
                <div class="section-card">
                    <div class="section-header">
                        <h5 class="section-title">Partner Count</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Count Text</label>
                            <input type="text" class="form-control" name="count_text"
                                   value="{{ $count && isset($count->value['text']) ? $count->value['text'] : 'Trades Axis is partner with over 100+ companies across the world' }}"
                                   placeholder="Enter partner count text">
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary save-button">
                        <i class="bi bi-save me-2"></i>Save All Changes
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
// Preview Hero Image
function previewImage(event, id) {
    const file = event.target.files[0];
    if (!file) return;
    
    const reader = new FileReader();
    reader.onload = function(e) {
        const previewBox = document.getElementById(id + '-preview-box');
        previewBox.classList.add('has-image');
        
        let img = previewBox.querySelector('.preview-image');
        if (img) {
            img.src = e.target.result;
        } else {
            img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'preview-image';
            img.id = id + '-preview';
            previewBox.insertBefore(img, previewBox.querySelector('.upload-text'));
        }
        
        if (!previewBox.querySelector('.btn-remove-image')) {
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn-remove-image';
            removeBtn.innerHTML = '✕';
            removeBtn.onclick = function(e) { 
                e.stopPropagation();
                removeImage(id); 
            };
            previewBox.insertBefore(removeBtn, previewBox.firstChild);
        }
        
        const uploadText = previewBox.querySelector('.upload-text');
        if (uploadText) {
            uploadText.textContent = 'Click to change image';
        }
    }
    reader.readAsDataURL(file);
}

function removeImage(id) {
    const previewBox = document.getElementById(id + '-preview-box');
    const fileInput = previewBox.querySelector('input[type="file"]');
    
    fileInput.value = '';
    
    const img = previewBox.querySelector('.preview-image');
    const removeBtn = previewBox.querySelector('.btn-remove-image');
    if (img) img.remove();
    if (removeBtn) removeBtn.remove();
    
    const uploadText = previewBox.querySelector('.upload-text');
    if (uploadText) {
        uploadText.textContent = 'Click to upload hero image';
    }
    
    previewBox.classList.remove('has-image');
    
    const oldInput = document.querySelector(`input[name="${id.replace(/-/g, '_')}_old"]`);
    if (oldInput) oldInput.value = '';
}

// Preview Brand Logo
function previewBrandLogo(event, index) {
    const file = event.target.files[0];
    if (!file) return;
    
    const reader = new FileReader();
    reader.onload = function(e) {
        const previewContainer = document.getElementById('brand-logo-preview-' + index);
        const img = document.getElementById('brand-logo-' + index);
        
        if (img) {
            img.src = e.target.result;
            if (previewContainer) {
                previewContainer.style.display = 'block';
            }
        }
    }
    reader.readAsDataURL(file);
}

// Add New Brand
let brandIndex = {{ $brands && isset($brands->value['items']) ? count($brands->value['items']) : 1 }};

function addBrand() {
    const container = document.getElementById('brands-container');
    const newBrand = document.createElement('div');
    newBrand.className = 'brand-item';
    newBrand.setAttribute('data-index', brandIndex);
    
    newBrand.innerHTML = `
        <div class="row align-items-center">
            <div class="col-md-4">
                <label class="form-label">Brand Name</label>
                <input type="text" class="form-control" name="brand_names[${brandIndex}]" placeholder="Brand name">
            </div>
            <div class="col-md-6">
                <label class="form-label">Brand Logo</label>
                <input type="file" class="form-control" name="brand_logos[${brandIndex}]" accept="image/*" onchange="previewBrandLogo(event, ${brandIndex})">
                <div class="mt-2" id="brand-logo-preview-${brandIndex}" style="display: none;">
                    <img src="" alt="Logo" class="brand-logo-preview" id="brand-logo-${brandIndex}">
                </div>
            </div>
            <div class="col-md-2 text-center">
                <label class="form-label d-block">&nbsp;</label>
                <button type="button" class="btn btn-remove-brand" onclick="removeBrand(this)">
                    <i class="bi bi-trash"></i> Remove
                </button>
            </div>
        </div>
    `;
    
    container.appendChild(newBrand);
    brandIndex++;
}

// Remove Brand
function removeBrand(button) {
    const brandItem = button.closest('.brand-item');
    if (document.querySelectorAll('.brand-item').length > 1) {
        brandItem.remove();
    } else {
        alert('You must have at least one brand!');
    }
}
</script>

@endsection