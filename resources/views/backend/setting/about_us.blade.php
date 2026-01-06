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

    .vision-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .vision-image-card {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
    }

    .image-number {
        background: #0d6efd;
        color: white;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 10px;
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
</style>

<div class="container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="bi bi-gear-fill me-2"></i>About Us Settings
            </h4>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('settings.about-us.update') }}" method="POST" enctype="multipart/form-data">
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
                                   value="{{ $hero->value['title'] ?? 'Who We Are' }}"
                                   placeholder="Enter hero title">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Hero Subtitle</label>
                            <textarea class="form-control" name="hero_subtitle" rows="4"
                                      placeholder="Enter hero subtitle description">{{ $hero->value['subtitle'] ?? '' }}</textarea>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Hero Image</label>
                            <div class="upload-preview-box {{ isset($hero->value['image']) && $hero->value['image'] ? 'has-image' : '' }}" id="hero-preview-box">
                                @if(isset($hero->value['image']) && $hero->value['image'])
                                    <button type="button" class="btn-remove-image" onclick="removeImage('hero')">✕</button>
                                    <img src="{{ asset($hero->value['image']) }}" class="preview-image" id="hero-preview">
                                @endif
                                <div class="upload-text">{{ isset($hero->value['image']) && $hero->value['image'] ? 'Click to change image' : 'Click to upload hero image' }}</div>
                                <div class="file-input-wrapper">
                                    <span class="btn-choose-file">Choose Image</span>
                                    <input type="file" name="hero_image" accept="image/*" onchange="previewImage(event, 'hero')">
                                </div>
                            </div>
                            <input type="hidden" name="hero_image_old" value="{{ $hero->value['image'] ?? '' }}">
                        </div>
                    </div>
                </div>

                {{-- ================= Mission Section ================= --}}
                <div class="section-card">
                    <div class="section-header">
                        <h5 class="section-title">Mission Section</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Mission Title</label>
                            <input type="text" class="form-control" name="mission_title"
                                   value="{{ $mission->value['title'] ?? 'We are here to complete a certain mission' }}"
                                   placeholder="Enter mission title">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Mission Description</label>
                            <textarea class="form-control" name="mission_description" rows="4"
                                      placeholder="Enter mission description">{{ $mission->value['description'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- ================= Vision Section ================= --}}
                <div class="section-card">
                    <div class="section-header">
                        <h5 class="section-title">Vision Section</h5>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Vision Title</label>
                            <input type="text" class="form-control" name="vision_title"
                                   value="{{ $vision->value['title'] ?? 'Our Vision' }}"
                                   placeholder="Enter vision title">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Vision Description</label>
                            <textarea class="form-control" name="vision_description" rows="4"
                                      placeholder="Enter vision description">{{ $vision->value['description'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <label class="form-label mb-3">Vision Images (4 images)</label>
                    <div class="vision-grid">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="vision-image-card">
                                <span class="image-number">{{ $i }}</span>
                                <div class="upload-preview-box {{ isset($vision->value['images'][$i-1]) && $vision->value['images'][$i-1] ? 'has-image' : '' }}" id="vision-{{ $i }}-preview-box">
                                    @if(isset($vision->value['images'][$i-1]) && $vision->value['images'][$i-1])
                                        <button type="button" class="btn-remove-image" onclick="removeImage('vision-{{ $i }}')">✕</button>
                                        <img src="{{ asset($vision->value['images'][$i-1]) }}" class="preview-image" id="vision-{{ $i }}-preview">
                                    @endif
                                    <div class="upload-text">{{ isset($vision->value['images'][$i-1]) && $vision->value['images'][$i-1] ? 'Click to change' : 'Click to upload' }}</div>
                                    <div class="file-input-wrapper">
                                        <span class="btn-choose-file">Choose</span>
                                        <input type="file" name="vision_image_{{ $i }}" accept="image/*" onchange="previewImage(event, 'vision-{{ $i }}')">
                                    </div>
                                </div>
                                <input type="hidden" name="vision_image_{{ $i }}_old" value="{{ $vision->value['images'][$i-1] ?? '' }}">
                            </div>
                        @endfor
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
function previewImage(event, id) {
    const file = event.target.files[0];
    if (!file) return;
    
    const reader = new FileReader();
    reader.onload = function(e) {
        const previewBox = document.getElementById(id + '-preview-box');
        previewBox.classList.add('has-image');
        
        // Remove old image if exists
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
        
        // Add remove button if not exists
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
        
        // Update text
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
    
    // Reset file input
    fileInput.value = '';
    
    // Remove image and button
    const img = previewBox.querySelector('.preview-image');
    const removeBtn = previewBox.querySelector('.btn-remove-image');
    if (img) img.remove();
    if (removeBtn) removeBtn.remove();
    
    // Update text
    const uploadText = previewBox.querySelector('.upload-text');
    if (uploadText) {
        uploadText.textContent = id.includes('vision') ? 'Click to upload' : 'Click to upload hero image';
    }
    
    previewBox.classList.remove('has-image');
    
    // Clear old image hidden input
    const oldInput = document.querySelector(`input[name="${id.replace(/-/g, '_')}_old"]`);
    if (oldInput) oldInput.value = '';
}
</script>

@endsection