
![Screenshot 2024-09-12 at 13 35 07](https://github.com/user-attachments/assets/4448a7ff-ec49-46fa-ba39-2b7f0268e35d)

# FlipperSnare by XsanLahci

## Overview

**FlipperSnare** is a user-friendly HTML and PHP live preview tool designed for web developers, pentesters, and security researchers. It offers an intuitive interface to input HTML or PHP code, visualize live previews, and make real-time adjustments. This tool is particularly useful for developers building fake login pages for MITM (Man-in-the-Middle) testing, or those conducting Evil Twin attacks using Flipper Zero. It also includes the ability to download the source code as an HTML file, making it easy to deploy or share testing scenarios.

## Features

- **Live HTML/PHP Preview**: Easily input your code and see the live preview instantly.
- **Dark Mode Support**: Toggle between light and dark mode for a more comfortable coding experience.
- **Resizable Preview Window**: Adjust the width and height of the live preview window using sliders.
- **Syntax Highlighting**: Built-in code editor with syntax highlighting for better code readability, powered by CodeMirror.
- **HTML Validation**: Validate your HTML structure in real-time and receive error feedback if the code contains issues.
- **Download HTML**: Save the inputted code as an HTML file for future use with just one click.
- **LocalStorage Support**: Automatically save your code locally in the browser, allowing you to continue your work later.

## Usage

1. Enter your HTML or PHP code into the provided input area.
2. Click the **Submit** button to update the live preview in the right-hand section.
3. Adjust the preview window's dimensions using the width and height sliders.
4. Toggle dark mode by clicking the **Dark Mode** button in the top right corner.
5. Download your code by clicking the **Download HTML** button.

## Benefits

- **No installation required**: This tool is purely browser-based, meaning you can start using it immediately by cloning the repository or running the code locally in a browser.
- **Ease of use**: The interface is intuitive and designed for quick interaction, making it ideal for both beginners and professionals.
- **Customizable preview**: Quickly adjust the preview's size to mimic various screen dimensions, helping you test responsive design.
- **Validation feedback**: Catch HTML errors early with built-in validation alerts that guide you to fix structural issues.

## How to Implement

- Simply clone or download the repository, then open the `index.html` file in any modern web browser.
- There is no need for any external installations; all required libraries like TailwindCSS, CodeMirror, and JSZip are imported via CDNs.

## Libraries and Technologies

- **TailwindCSS**: For the responsive and modern user interface.
- **CodeMirror**: Provides syntax highlighting and code editing features.
- **JSZip**: Allows the download functionality for the HTML file.

## Contributing

Contributions are welcome! Feel free to fork this repository and submit pull requests for enhancements or bug fixes.

## License

This project is licensed under the MIT License.
